<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdjustAttendance;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    public function getIndex()
    {
        $user = Auth::user();
        return view('index', ['user' => $user]);
    }

    public function startAttendance()
    {
        $user = Auth::user();
        $startAttendanceTime = Carbon::now();
        User::create([
            'date' => $startAttendanceTime->format('YYYY-mm-dd'),
            'start_working' => $startAttendanceTime,
            'id_u' => $user->id
        ]);
        return redirect('/');
    }

    public function endAttendance()
    {
        $user = Auth::user();
        $endAttendanceTime = Carbon::now();
        User::create([
            'date' => $endAttendanceTime->format('YYYY-mm-dd'),
            'end_working' => $endAttendanceTime,
            'id_u' => $user->id
        ]);
        return redirect('/');
    }

    public function getAttendance(Request $request)
    {
        //計算機能のインスタンス作成
        $adjustAttendance = new AdjustAttendance;
        //requestをintegerにする
        $num = (int)$request;
        $dt = new Carbon();
        //$attendanceStamps = 
        if ($num == 0) {
            //$dtをそのまま送って、その日の全スタンプを取得
            $todaysAttendance = User::where('date', $dt)->distinct();
            echo
            //その日の日付を送って、ユーザーごとの配列になった勤怠情報、日付を取得
            $adjustedAttendance = $adjustAttendance->adjustAttendance($todaysAttendance);
        } else {
            //過去の日付を送って、その日の全スタンプを取得
            $pastAttendance = User::where('date', $dt->subDay($num))->distinct();
            //過去の日付を送って、ユーザーごとの配列になった勤怠情報、日付を取得
            $adjustedAttendance = $adjustAttendance->adjustAttendance($pastAttendance);
        }
        
        return
        view('date', $adjustedAttendance);







        $adjustAttendance = new AdjustAttendance;
        $adjustAtteOutput = $adjustAttendance->adjustAttendance();
        $items = [
            'dt' => $dt,
            'name' => $$adjustAtteOutput['name'],
            'startBreakSet' => $adjustAtteOutput['startBreakSet'],
            'endBreakSet' => $adjustAtteOutput['endBreakSet'],
            '$activeWorkingSum' => $adjustAtteOutput['activeWorkingSum'],
            'breakSum' => $adjustAtteOutput['breakSum']
        ];

        return view('date', $items);
    }
}
