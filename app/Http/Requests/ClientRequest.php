<?php

namespace App\Http\Requests;

use App\Rules\ValidateEmail;
use App\Rules\ValidatePassword;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'login') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|between:8,20',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスが入力されていません。',
            'email.string' => 'メールアドレスが文字列ではありません。',
            'email.email' => 'メールアドレスの形式ではありません。',
            'email.max:255' => 'メールアドレスが長すぎます。',
            'password.required' => 'パスワードが入力されていません。',
            'password.between:8,20' => 'パスワードは8~20文字でお願いします。',
        ];
    }
}
