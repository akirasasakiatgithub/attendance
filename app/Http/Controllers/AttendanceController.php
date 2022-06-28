<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
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
        $startAttendanceTime = Carbon::now();
        //ddd($startAttendanceTime->format('H:i:s'));
        Attendance::insert([
            'date' => $startAttendanceTime->format('Y-m-d'),
            'start_working' => $startAttendanceTime->format('H:i:s'),
            'id_u' => Auth::id()
        ]);
        return redirect('/');
    }

    public function endAttendance()
    {
        $endAttendanceTime = Carbon::now();
        Attendance::create([
            'date' => $endAttendanceTime->format('Y-m-d'),
            'end_working' => $endAttendanceTime->format('H:i:s'),
            'id_u' => Auth::id()
        ]);
        return redirect('/');
    }

    public function getAttendance(Request $request)
    {
        if ($request->date) {
            $date = $request->date;
        } else {
            $now = new Carbon();
            $date = $now->format('Y-m-d');               //string型の日時を代入
        }
        $AtteList = adjustAttendance($date);
        $BreakList = adjustBreak($date);
        if ($AtteList) {
            $totalList = connectCollection($AtteList, $BreakList);
            $param = [
                'attes' => $totalList,
                'date' => $date
            ];
        } else {
            $param = [
                'attes' => null,
                'date' => $date
            ];
        }
        return view ('attendanceList', $param);
    }

    public function getPersonAttendance(Request $request)
    {
        $user = Auth::user();
        if ($request->date) {
            $date = $request->date;
            $psnAtteList = searchAttePsn($user, $date);
            $psnBreakList = searchBreakPsn($user, $date);
        }
        $psnAtteList = searchAttePsn($user);
        $psnBreakList = searchBreakPsn($user);
        if ($psnAtteList) {
            $totalList = connectCollection($psnAtteList, $psnBreakList);
            $param = [
                'attes' => $totalList,
                'name' => $user->name
            ];
        } else {
            $param = [
                'attes' => null,
                'name' => $user->name
            ];
        }
        return view ('personAttendanceList', $param);
    }

    public function test()
    {
        $attendance = new Attendance;
    }
}
