<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AtteController extends Controller
{
    public function date()
    {
        //return view('date', [''])
    }





    /*public function submit(Request $request)
    {
        $form = $request->all();
        User::create($form);
        $user = Auth::user();
        return redirect('/');
    }*/



    public function start_break(Request $request)
    {
        $startBreak = $request->start_break();
        User::create($startBreak);
        $user = Auth::user();
        return redirect('/');
    }

    public function end_break(Request $request)
    {
        $endBreak = $request->end_break();
        User::create($endBreak);
        $user = Auth::user();
        return redirect('/');
    }
}
