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
        $atteList = searchAttendance($date);
        $breakList = searchBreak($date);
        $perPage = 5;
        $paginateInfo = Attendance::where('date', $date)->distinct('id_a')->paginate($perPage);
        if ($atteList) {
            $totalList = connectCollection($atteList, $breakList)->sortBy($sort);
            $param = [
                'items' => $totalList,
                'date' => $date,
                'sort' => $sort,
                'paginateInfo' => $paginateInfo
            ];
        } else {
            $param = [
                'items' => null,
                'date' => $date,
                'sort' => $sort,
                'paginateInfo' => $paginateInfo
            ];
        }
        return view('attendanceList', $param);
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
            $perPage = 5;
            $totalList = connectCollection($psnAtteList, $psnBreakList)->sortBy($sort)->paginate($perPage);
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
        return view('personAttendanceList', $param);
    }

    public function test()
    {
        $attendance = new Attendance;
    }
}
