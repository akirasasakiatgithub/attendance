<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $
    }

    public function submit(Request $request)
    {
        if ($user)
    }

    public function record(Request $request)
    {

    }
}
