<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\ClientRequest;
use App\Rules\ValidateEmail;
use App\Rules\ValidatePassword;
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
    public function postRegister(ClientRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return view('login');
        } catch (\Throwable $th) {
            return view('register', ['message' => '登録に失敗しました。']);
        }
    }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(ClientRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $credidentials = ['email' => $email, 'password' => $password];
        if (Auth::attempt($credidentials)) {
            return redirect('/');
        } else {
            return view('login', [ 'message' => 'パスワードまたはメールアドレスが間違っています。']);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return view('login');
    }
}
