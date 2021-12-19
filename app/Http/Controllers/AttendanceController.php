<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        User::create([
            'date' => $startAttendanceTime->format('YYYY-mm-dd'),
            'start_working' => $startAttendanceTime,
            'id_u' => $user->id
        ]);
        return redirect('/');
    }

    public function endAttendance()
    {
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
        
    }
}
