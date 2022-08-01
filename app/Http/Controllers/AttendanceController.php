<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
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
            'user_id' => Auth::id()
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
            'user_id' => Auth::id()
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
        $atteLists = searchAttendance($date);
        $breakLists = searchBreak($date);
        // ddd($request);
        if ($atteLists) {
            $perPage = 5;
            $totalLists = connectCollection($atteLists, $breakLists);
            $totalLists = new LengthAwarePaginator(
                $totalLists->forPage($request->page, $perPage),
                count($totalLists),
                $perPage,
                $request->page,
            );
            $param = [
                'items' => $totalLists,
                'date' => $date,
            ];
        } else {
            $param = [
                'items' => null,
                'date' => $date,
            ];
        }
        return view('attendanceList', $param);
    }

    public function getPersonAttendance(Request $request)
    {
        $user = Auth::user();
        if ($request->date) {
            $date = $request->date;
            $psnAtteList = searchAttePsn($date);
            $psnBreakList = searchBreakPsn($date);
        } else {
            $psnAtteList = searchAttePsn();
            $psnBreakList = searchBreakPsn();
        }

        if ($psnAtteList) {
            $perPage = 5;
            $totalLists = connectCollection($psnAtteList, $psnBreakList);
            $totalLists = new LengthAwarePaginator(
                $totalLists->forPage($request->page, $perPage),
                count($totalLists),
                $perPage,
                $request->page,
                array('path' => $request->url()),
            );
            $param = [
                'items' => $totalLists,
                'name' => $user->name,
            ];
        } else {
            $param = [
                'items' => null,
                'name' => $user->name,
            ];
        }
        return view('personAttendanceList', $param);
    }
}
