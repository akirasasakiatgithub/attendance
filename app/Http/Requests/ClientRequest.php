<?php

namespace App\Http\Requests;

use App\Rules\CheckAtWork;
use App\Rules\CheckBeforeWork;
use App\Rules\CheckEndBreak;
use App\Rules\CheckNotEndWork;
use App\Rules\CheckStartBreak;
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
        if ($this->path() == ('/' || '/register' || '/login' || '/attendance/start' || '/attendance/end' || 'break/start' || 'break/end')) {
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'digits_between:8,20',
            'start_working' => [new CheckBeforeWork],
            'end_working' => [new CheckNotEndWork, new CheckAtWork, new CheckEndBreak],
            'start_break' => [new CheckEndBreak, new CheckAtWork, new CheckNotEndWork],
            'end_break' => [new CheckStartBreak, new CheckAtWork, new CheckNotEndWork]
        ];
    }
}
