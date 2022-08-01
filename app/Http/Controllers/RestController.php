<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Rest;

class RestController extends Controller
{
    public function startBreak()
    {
        $user = Auth::user();
        $startBreakTime = Carbon::now();
        $rest = new Rest;
        $attendance = new Attendance;
        $attendance->validateAtWork($startBreakTime);
        $rest->validateEndBreak($startBreakTime);
        $attendance->validateNotEndWork($startBreakTime);
        Rest::create([
            'date' => $startBreakTime->format('Y-m-d'),
            'start_break' => $startBreakTime->format('Y-m-d H:i:s'),
            'user_id' => $user->id
        ]);
        return redirect('/');
    }

    public function endBreak()
    {
        $user = Auth::user();
        $endBreakTime = Carbon::now();
        $rest = new Rest;
        $attendance = new Attendance;
        $rest->validateStartBreak($endBreakTime);
        $attendance->validateAtWork($endBreakTime);
        $attendance->validateNotEndWork($endBreakTime);
        Rest::create([
            'date' => $endBreakTime->format('Y-m-d'),
            'end_break' => $endBreakTime->format('Y-m-d H:i:s'),
            'user_id' => $user->id
        ]);
        return redirect('/');
    }
}
