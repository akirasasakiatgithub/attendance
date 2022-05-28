<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

//認証していなければログイン後のページを見せない処理
//ログイン済ならindexへのリダイレクト
//ログアウト機能確認
class AuthController extends Controller
{
    public function getRegister()
    {
        return view('register');
    }
    //try文確認
    public function postRegister(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);
            return redirect('login');
        } catch (\Throwable $th) {
            return redirect('/register', ['txt' => '登録に失敗しました。']);
        }
    }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user($request);
            return view('index', ['user' => $user]);
        } else {
            return redirect('/login', ['txt' => 'ログインに失敗しました。']);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/login', ['txt' => 'ログアウトしました。']);
    }
}
