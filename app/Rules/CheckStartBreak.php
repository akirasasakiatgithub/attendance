<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Rest;
use Carbon\Carbon;

class CheckStartBreak implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->id = Auth::id();
        $this->now = new Carbon();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $lastStartBreak = Rest::where('date', $this->now->format('Y:m:d'))->where('id_u', $this->id)->whereNotNull('start_break')->max('start_break');
        $lastEndBreak = Rest::where('date', $this->now->format('Y:m:d'))->where('id_u', $this->id)->whereNotNull('end_break')->max('start_break');
        return $lastStartBreak > $lastEndBreak;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '未だ休憩を開始していません。';
    }
}
