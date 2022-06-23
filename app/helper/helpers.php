<?php

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
    function adjustAttendance(string $date)
    {
        $dailyAtte = Attendance::where('date', $date)->get();
        $dataSet = collect([]);
        if ($dailyAtte->isNotEmpty()) {
            $idlistA = $dailyAtte->unique('id_u')->pluck('id_u');
            for ($i = 0; $i < count($idlistA); $i++) {
                //$dailyAtteから$idlistA[i]でデータを引き出し
                $personAtte = $dailyAtte->where('id_u', $idlistA[$i]);
                $startWork = new Carbon($personAtte->whereNotNull('start_working')->pluck('start_working')->first());
                $endWork = new Carbon($personAtte->whereNotNull('end_working')->pluck('end_working')->first());
                //時間の計算
                $workTime = $startWork->diff($endWork);
                $name = User::where('id', $idlistA[$i])->value('name');
                $psnData = collect(['idlist_a' => $idlistA[$i], 'name' => $name, 'start_work' => $startWork->format('H:i:s'), 'end_work' => $endWork->format('H:i:s'), 'work_time' => $workTime->format('%H:%I:%S')]);
                $dataSet[$i] = $psnData;
            }
        } else {
            $dataSet = null;
        }
        //:([[int idlist[$i], string $userName, DateTime $startWork, DateTime $endWork, DateInterval $workTime]])
        return $dataSet;
    }

}

if (!function_exists('adjustBreak')) {
    /**
     * 関数の説明文
     *
     * @param  string  $xxx
     */
    function adjustBreak(string $date)
    {
        $dailyBreak = Rest::where('date', $date)->get();
        $dataSet = collect([]);
        if ($dailyBreak->isNotEmpty()) {
            $idlistB = $dailyBreak->unique('id_u')->pluck('id_u');
            for ($i = 0; $i < count($idlistB); $i++) {
                $personBreak = $dailyBreak->where('id_u', $idlistB[$i]);             //$dailyBreakから$idlistB[i]でデータを引き出し
                //！※休憩は何度でもとってよいことに留意！
                $totalBreakSecond = 0;
                $breakNum = (count($personBreak) / 2);
                for ($j = 0; $j < $breakNum; $j++) {
                    $startBreak = new Carbon($personBreak->whereNotNull('start_break')->pluck('start_break')->get($j));
                    $endBreak = new Carbon($personBreak->whereNotNull('end_break')->pluck('end_break')->get($j));
                    $startUnixTime = $startBreak->getTimestamp();
                    $endUnixTime = $endBreak->getTimestamp();
                    $breakTime = $endUnixTime - $startUnixTime;                 //unixタイムスタンプを使って休憩時間を求める
                    $totalBreakSecond += $breakTime;
                }
                $totalBreak = new DateInterval('PT' . $totalBreakSecond . 'S');
                /* $totalSecond = (int)$totalBreakSecond % 60;
                $totalMinute = ($totalBreakSecond / 60) % 60;           //小数点以下考慮してない
                $totalHour = ($totalBreakSecond / 60) / 60;　*/
                $psnData = collect(['idlist_b' => $idlistB[$i], 'break_time' => $totalBreak->format('%H:%I:%S')]);
                $dataSet[$i] = $psnData;
            }
        }
        //:([[int $idlistB[i], DateInterval $totalBreak]])
        return $dataSet;
    }
}

if (! function_exists('connectCollection')) {
    /**
     * 関数の説明文
     *
     * @param  string  $xxx
     */
    function connectCollection(object $collectionA, object $collectionB)
    {
        $idlistA = $collectionA->pluck('idlist_a');
        $idlistB = $collectionB->pluck('idlist_b');
        for ($i = 0; $i < count($idlistA); $i++) {
            $idBExist = $idlistB->search($idlistA[$i]);
            if (!($idBExist === false)) {
                $btVal = $collectionB->where('idlist_b', $idlistA[$i])->first()->get('break_time');
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

if (! function_exists('searchAttePsn')) {
    /**
     * 関数の説明文
     *
     * @param  string  $xxx
     */
    function searchAttePsn($user, $date = 'all')
    {
        $psnId = User::where('email', $user->email)->first()->id;
        //->value('id')で違う人のIDが出てくる理由を聞く
        $psnAtte = Attendance::where('id_u', $psnId)->get();
        if (!($date === 'all')) {
            $psnAtte = $psnAtte->where('date', $date);
        }
        $dateList = $psnAtte->unique('date')->pluck('date');
        $dataSet = collect([]);
        $forNum = (count($dateList));
        //dd($forNum);
        if ($psnAtte->isNotEmpty()) {
            for ($i = 0; $i < $forNum; $i++) {
                $psnStrt = new Carbon($psnAtte->whereNotNull('start_working')->pluck('start_working')->get($i));
                $psnEnd = new Carbon($psnAtte->whereNotNull('end_working')->pluck('end_working')->get($i));
                //$psnEnd = new Carbon($psnAtte->whereNotNull('end_working')->where('date',$dateList[$i])->value('end_working'));
                $psnDate = new Carbon($dateList[$i]);
                $workTime = $psnStrt->diff($psnEnd);
                $dailyData = collect(['start_work' => $psnStrt->format('H:i:s'), 'end_work' => $psnEnd->format('H:i:s'), 'date' => $psnDate->format('Y:m:d'), 'work_time' => $workTime->format('%H:%I:%S')]);
                $dataSet[$i] = $dailyData;
            }
        } else {
                $dataSet = null;
        }
        return $dataSet;
    }
}

if (! function_exists('searchBreakPsn')) {
    /**
     * 関数の説明文
     *
     * @param  string  $xxx
     */
    function searchBreakPsn($user, $date = 'all')
    {
        $psnId = User::where('email', $user->email)->first()->id;
        $psnBreak = Rest::where('id_u', $psnId)->get();
        if (!($date === 'all')) {
            $psnBreak = $psnBreak->where('date', $date);
        }
        $dateList = $psnBreak->unique('date')->pluck('date');
        $dataSet = collect([]);
        if ($psnBreak->isNotEmpty()) {
            for ($i = 0; $i < count($dateList); $i++) {
                $dailyBreak = $psnBreak->where('date', $dateList[$i]);
                $dailyBreakSecond = 0;
                for ($j = 0; $j < count($dailyBreak) / 2; $j++) {
                    $startBreak = new Carbon($dailyBreak->whereNotNull('start_break')->pluck('start_break')->get($j));
                    $endBreak = new Carbon($dailyBreak->whereNotNull('end_break')->pluck('end_break')->get($j));
                    $startUnixTime = $startBreak->getTimestamp();
                    $endUnixTime = $endBreak->getTimestamp();
                    $breakSecond = $endUnixTime - $startUnixTime;
                    $dailyBreakSecond += $breakSecond;
                }
                $date = $dailyBreak->first()->get('date');
                $dailyBreak = new DateInterval("PT{$dailyBreakSecond}S");
                $dailyData = collect(['idlist_b' => $date, 'break_time' => $dailyBreak->format('%H:%I:%S')]);
                $dataSet[$i] = $dailyData;
            }
        } else {
            $dataSet = Null;
        }
        return $dataSet;
    }
}
