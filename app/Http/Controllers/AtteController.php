<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AtteController extends Controller
{
    public function register(Request $request)
    {
        
        //return view('register', [''])
    }

    public function login()
    {
        return view('/login');
    }

    public function date()
    {
        //return view('date', [''])
    }

    public function stamp(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email,'password' => $password])) {
            $user = Auth::user($request);
            return view('stamp', ['user' => $user]);
        } else {
            $txt = 'ログインに失敗しました。';
        return redirect('/login',['txt' => $txt]);
        }
    }

    public function home()
    {
        $user = Auth::user();
        return view('stamp', ['user' => $user]);
    }

    /*public function submit(Request $request)
    {
        $form = $request->all();
        User::create($form);
        $user = Auth::user();
        return redirect('/');
    }*/

    public function start_working(Request $request)
    {
        $startWorking = $request->start_working();
        User::create($startWorking);
        $user = Auth::user();
        return redirect('/');
    }

    public function end_working(Request $request)
    {
        $endWorking = $request->end_working();
        User::create($endWorking);
        $user = Auth::user();
        return redirect('/');
    }

    public function start_breaketime(Request $request)
    {
        $startBreaketime = $request->start_breaketime();
        User::create($startBreaketime);
        $user = Auth::user();
        return redirect('/');
    }

    public function end_breaketime(Request $request)
    {
        $endBreaketime = $request->end_breaketime();
        User::create($endBreaketime);
        $user = Auth::user();
        return redirect('/');
    }

    public function record(Request $request)
    {
        $dt = Carbon::now();
        $item = User::where(start_working_at)->paginate(5);
        return
    }
}
