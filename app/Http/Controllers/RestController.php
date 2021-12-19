<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RestController extends Controller
{
    //carbonで現在時刻取得
    public function startRest()
    {
        //format確認
        $user = Auth::user();
        $startRestTime = Carbon::now();
        User::create([
            'start_break' => $startRestTime,
            'id_u' => $user->id
        ]);
        return redirect('/');
    }

    public function endRest()
    {
        $user = Auth::user();
        $endRestTime = Carbon::now();
        User::create([
            'end_break' => $endRestTime,
            'id_u' => $user->id
        ]);
        return redirect('/');
    }
}
