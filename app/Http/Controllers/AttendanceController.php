<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
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
        $attendance = new Attendance;
        $attendance->validateBeforeWork($startAttendanceTime);
        Attendance::create([
            'date' => $startAttendanceTime->format('Y-m-d'),
            'start_working' => $startAttendanceTime->format('Y-m-d H:i:s'),
            'id_u' => Auth::id()
        ]);
        return redirect('/');
    }

    public function endAttendance()
    {
        $endAttendanceTime = Carbon::now();
        $attendance = new Attendance;
        $attendance->validateAtWork($endAttendanceTime);
        $attendance->validateNotEndWork($endAttendanceTime);
        $rest = new Rest;
        $rest->validateEndBreak($endAttendanceTime);
        Attendance::create([
            'date' => $endAttendanceTime->format('Y-m-d'),
            'end_working' => $endAttendanceTime->format('Y-m-d H:i:s'),
            'id_u' => Auth::id()
        ]);
        return redirect('/');
    }

    public function getAttendance(Request $request)
    {
        $sort = $request->sort;
        if ($request->date) {
            $date = $request->date;
        } else {
            $now = new Carbon();
            $date = $now->format('Y-m-d');               //string型の日時を代入
        }
        $AtteList = adjustAttendance($date);
        $BreakList = adjustBreak($date);
        if ($AtteList) {
            $totalList = connectCollection($AtteList, $BreakList)->sortBy($sort)->paginate(5);
            ddd($totalList);
            $param = [
                'items' => $totalList,
                'date' => $date,
                'sort' => $sort
            ];
        } else {
            $param = [
                'items' => null,
                'date' => $date,
                'sort' => $sort
            ];
        }
        return view ('attendanceList', $param);
    }

    public function getPersonAttendance(Request $request)
    {
        $sort = $request->sort;
        $user = Auth::user();
        if ($request->date) {
            $date = $request->date;
            $psnAtteList = searchAttePsn($user, $date);
            $psnBreakList = searchBreakPsn($user, $date);
        }
        $psnAtteList = searchAttePsn($user);
        $psnBreakList = searchBreakPsn($user);
        if ($psnAtteList) {
            $totalList = connectCollection($psnAtteList, $psnBreakList)->sortBy($sort)->paginate(5);
            $param = [
                'items' => $totalList,
                'name' => $user->name,
                'sort' => $sort
            ];
        } else {
            $param = [
                'items' => null,
                'name' => $user->name,
                'sort' => $sort
            ];
        }
        return view ('personAttendanceList', $param);
    }

    public function test()
    {
        $attendance = new Attendance;
    }
}
