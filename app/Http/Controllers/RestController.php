<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Rest;

class RestController extends Controller
{
    //carbonで現在時刻取得
    public function startBreak()
    {
        $user = Auth::user();
        $startBreakTime = Carbon::now();
        Rest::insert([
            'date' => $startBreakTime,
            'start_break' => $startBreakTime,
            'id_u' => $user->id
        ]);
        return redirect('/');
    }

    public function endBreak()
    {
        $user = Auth::user();
        $endBreakTime = Carbon::now();
        Rest::insert([
            'date' => $endBreakTime,
            'end_break' => $endBreakTime,
            'id_u' => $user->id
        ]);
        return redirect('/');
    }
}
