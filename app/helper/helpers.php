<?php

use App\ConvertPaginator\ConvertPaginatorToSearchResultModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;


if (!function_exists('adjustAttendance')) {
    /**
     * 関数の説明文
     *
     * @param  string  $xxx
     */
    function searchAttendance(string $date)
    {
        // 検索対象日の全レコードを取得
        $dailyAtte = Attendance::where('date', $date)->get();
        $dataSet = collect([]);
        // 全レコードから$idListAを元に個人ごとのレコードを取得。
        if ($dailyAtte->isNotEmpty()) {
            $idlistA = $dailyAtte->unique('user_id')->pluck('user_id');
            for ($i = 0; $i < count($idlistA); $i++) {
                $personAtte = $dailyAtte->where('user_id', $idlistA[$i]);
                $startWork = new Carbon($personAtte->whereNotNull('start_working')->pluck('start_working')->first());
                $getTimeValue = $personAtte->whereNotNull('end_working')->pluck('end_working')->first();
                $endWork = new Carbon($getTimeValue);
                //勤務時間の計算
                $workTime = $startWork->diff($endWork);
                $name = User::where('id', $idlistA[$i])->value('name');
                //勤務中の場合は勤務終了を---、勤務時間の後に（勤務中）と表示する。
                if (isset($getTimeValue)) {
                    $endWork = $endWork->format('H:i:s');
                    $workTime = $workTime->format('%H:%I:%S');
                } else {
                    $endWork = '---';
                    $workTime =  $workTime->format('%H:%I:%S') . '（勤務中）';
                }
                $psnData = collect(['idlist_a' => $idlistA[$i], 'name' => $name, 'start_work' => $startWork->format('H:i:s'), 'end_work' => $endWork, 'work_time' => $workTime]);
                $dataSet[$i] = $psnData;
            }
        } else {
            $dataSet = null;
        }
        //:([[int idlist[$i], string $userName, DateTime $startWork, DateTime $endWork, DateInterval $workTime]])
        //ddd($dataSet);
        return $dataSet;
    }
}

if (!function_exists('adjustBreak')) {
    /**
     * 関数の説明文
     *
     * @param  string  $xxx
     */
    function searchBreak(string $date)
    {
        $dailyBreak = Rest::where('date', $date)->get();
        $dataSet = collect([]);
        if ($dailyBreak->isNotEmpty()) {
            $idlistB = $dailyBreak->unique('user_id')->pluck('user_id');
            for ($i = 0; $i < count($idlistB); $i++) {
                //！※休憩は何度でもとってよいことに留意！
                //個人の全休憩レコードを取得
                $personBreak = $dailyBreak->where('user_id', $idlistB[$i]);
                $totalBreakSeconds = 0;
                //$personBreakの個数が奇数になる人（現在休憩中の人）のための分岐
                if (count($personBreak) % 2 == 0) {
                    $breakNum = (count($personBreak) / 2);
                } else {
                    $breakNum = ((count($personBreak) + 1) / 2);
                }
                for ($j = 0; $j < $breakNum; $j++) {
                    $startBreak = new Carbon($personBreak->whereNotNull('start_break')->pluck('start_break')->get($j));
                    // 休憩終了がnull（休憩中）の場合、閲覧時刻でCarbonインスタンス生成　→　閲覧の時点での総休憩時間を表示
                    $endBreak = new Carbon($personBreak->whereNotNull('end_break')->pluck('end_break')->get($j));
                    $startUnixTime = $startBreak->getTimestamp();
                    $endUnixTime = $endBreak->getTimestamp();
                    $breakTime = $endUnixTime - $startUnixTime;                 //unixタイムスタンプを使って休憩時間を求める
                    $totalBreakSeconds += $breakTime;
                }
                $displaySeconds = (int)$totalBreakSeconds % 60;
                $displayMinutes = floor($totalBreakSeconds / 60);
                $displayHours = floor($displayMinutes / 60);
                $totalBreak = new DateInterval("PT{$displayHours}H{$displayMinutes}M{$displaySeconds}S");
                $psnData = collect(['idlist_b' => $idlistB[$i], 'break_time' => $totalBreak->format('%H:%I:%S')]);
                $dataSet[$i] = $psnData;
            }
        }
        //:([[int $idlistB[i], DateInterval $totalBreak]])
        return $dataSet;
    }
}

if (!function_exists('connectCollection')) {
    /**
     * 別々のモデルから引き出されたCollectionをつなげる
     *
     * @param  object  $collectionA, object $collectionB
     */
    function connectCollection(object $collectionA, object $collectionB)
    {
        $idlistA = $collectionA->pluck('idlist_a');
        $idlistB = $collectionB->pluck('idlist_b');
        $totalCollection = collect([]);
        for ($i = 0; $i < count($idlistA); $i++) {
            $idBExist = $idlistB->search($idlistA[$i]);
            if (!($idBExist === false)) {
                $btVal = $collectionB->where('idlist_b', $idlistA[$i])->first()->get('break_time');
                //ddd($btVal);
                $totalCollection[$i] = $collectionA[$i]->put('break_time', $btVal);
            } else {
                $totalCollection[$i] = $collectionA[$i]->put('break_time', '00:00:00');
            }
        }
        //:([[int idlist, string $userName, DateTime $startWork, DateTime $endWork, DateInterval $workTime, DateInterval $totalBreak or string '00:00:00']])
        //dd($totalCollection);
        return $totalCollection;
    }
}

if (!function_exists('searchAttePsn')) {
    /**
     * ログインしている人の勤怠記録を表示する
     *
     * @param  object $user  string $date
     */
    function searchAttePsn($date = false)
    {
        //現在ログインしている人のidでモデルからこれまでの勤怠記録（休憩除く）を全て取得
        //日にちで検索した場合は、引数で与えられた日にちで絞り込み
        $psnId = Auth::id();
        $psnAtte = Attendance::where('user_id', $psnId)->when($date, function ($query, $date) {
            return $query->where('date', $date);
        }, function ($query) {
            return $query;
        })
            ->get();
        //日ごとに出勤・退勤のレコードがあるので、それらをまとめて出勤日のカラムの値を順に引き出し
        $dateList = $psnAtte->unique('date')->pluck('date');
        $dataSet = collect([]);

        //for文を回す回数
        $forNum = (count($dateList));
        //$forNumの値は意図通り1
        // ddd($forNum);

        //これまでの勤務記録があれば、for文内で分類、計算
        if ($psnAtte->isNotEmpty()) {
            for ($i = 0; $i < $forNum; $i++) {
                //出勤時間のカラムから値を順に引き出し,その値でCarbonインスタンス生成
                $psnStrt = new Carbon($psnAtte->whereNotNull('start_working')->pluck('start_working')->get($i));
                //退勤時間のカラムから値を順に引き出し,その値でCarbonインスタンス生成
                //勤務中の人の為に、①で条件を分岐
                $getTimeValue = $psnAtte->whereNotNull('end_working')->pluck('end_working')->get($i);
                $psnEnd = new Carbon($getTimeValue);
                //出勤時間と退勤時間の差で勤務時間を計算
                $workTime = $psnStrt->diff($psnEnd);

                // ①退勤時間の値があれば退勤時間と勤務時間を記録
                if (isset($getTimeValue)) {
                    $psnEnd = $psnEnd->format('H:i:s');
                    $workTime = $workTime->format('%H:%I:%S');
                } else {
                    //退勤時間の値が無い（勤務中）なら、それぞれ以下のように記録
                    $psnEnd = '---';
                    $workTime = $workTime->format('%H:%I:%S') . '勤務中';
                }
                //一日の出勤日、出勤時間、退勤時間、勤務時間のリストをコレクションにする。
                $dailyData = collect(['idlist_a' => $dateList[$i], 'start_work' => $psnStrt->format('H:i:s'), 'end_work' => $psnEnd, 'work_time' => $workTime]);
                //コレクションを配列に加えていく。
                $dataSet[$i] = $dailyData;
            }
        } else {
            $dataSet = null;
        }
        return $dataSet;
    }
}

if (!function_exists('searchBreakPsn')) {
    /**
     * 関数の説明文
     *
     * @param  string  $xxx
     */
    function searchBreakPsn($date = 'all')
    {
        $psnId = Auth::id();
        $psnBreak = Rest::where('user_id', $psnId)->get();
        if (!($date === 'all')) {
            $psnBreak = $psnBreak->where('date', $date);
        }
        $dateList = $psnBreak->unique('date')->pluck('date');
        $dataSet = collect([]);
        if ($psnBreak->isNotEmpty()) {
            for ($i = 0; $i < count($dateList); $i++) {
                $dailyBreak = $psnBreak->where('date', $dateList[$i]);
                //if($i==2){ddd($dailyBreak);}
                $dailyBreakSeconds = 0;
                //$dailyBreakの個数が奇数になる場合（現在休憩中の場合）のための分岐
                if (count($dailyBreak) % 2 == 0) {
                    $breakNum = (count($dailyBreak) / 2);
                } else {
                    $breakNum = ((count($dailyBreak) + 1) / 2);
                }
                for ($j = 0; $j < $breakNum; $j++) {
                    $startBreak = new Carbon($dailyBreak->whereNotNull('start_break')->pluck('start_break')->get($j));
                    // 休憩終了がnull（休憩中）の場合、閲覧時刻でCarbonインスタンス生成　→　閲覧の時点での総休憩時間を表示
                    $getTimeValue = $dailyBreak->whereNotNull('end_break')->pluck('end_break')->get($j);
                    $endBreak = new Carbon($getTimeValue);
                    $startUnixTime = $startBreak->getTimestamp();
                    $endUnixTime = $endBreak->getTimestamp();
                    $breakSeconds = $endUnixTime - $startUnixTime;
                    $dailyBreakSeconds += $breakSeconds;
                }
                $date = $dailyBreak->first()->date;
                $displaySeconds = (int)$dailyBreakSeconds % 60;
                $displayMinutes = floor($dailyBreakSeconds / 60);
                $displayHours = floor($displayMinutes / 60);
                $dailyBreak = new DateInterval("PT{$displayHours}H{$displayMinutes}M{$displaySeconds}S");
                $dailyData = collect(['idlist_b' => $date, 'break_time' => $dailyBreak->format('%H:%I:%S')]);
                $dataSet[$i] = $dailyData;
            }
        } else {
            $dataSet = Null;
        }
        return $dataSet;
    }
}

if (!function_exists('search')) {
    /**
     * 関数の説明文
     *
     * @param  string  $xxx
     */
    function search($perPage, $date)
    {
        $searchResult = Attendance::where('date', $date)->paginate($perPage);
        $convertSearchResult = new ConvertPaginatorToSearchResultModel($searchResult);
        return $convertSearchResult;
    }
}
