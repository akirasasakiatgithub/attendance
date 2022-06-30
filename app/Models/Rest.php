<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class Rest extends Model
{
    use HasFactory;

    protected $guarded = [
        'id_r',
        'created_at',
        'update_at',
    ];

    protected $fillable = [
        'id_u',
        'date',
        'start_break',
        'end_break',
    ];

    public function attendance()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function validateEndBreak($now): void
    {
        $lastStartBreak = self::where('date', $now->format('Y:m:d'))->where('id_u', Auth::id())->whereNotNull('start_break')->max('start_break');
        $lastEndBreak = self::where('date', $now->format('Y:m:d'))->where('id_u', Auth::id())->whereNotNull('end_break')->max('end_break');
        $result = $lastStartBreak > $lastEndBreak;
        if ($result) {
            throw ValidationException::withMessages(['start_working' => ['未だ休憩を終了していません。'],]);
        }
    }

    public function validateStartBreak($now): void
    {
        $lastStartBreak = self::where('date', $now->format('Y:m:d'))->where('id_u', Auth::id())->whereNotNull('start_break')->max('start_break');
        $lastEndBreak = self::where('date', $now->format('Y:m:d'))->where('id_u', Auth::id())->whereNotNull('end_break')->max('end_break');
        $result = $lastStartBreak <= $lastEndBreak;
        //ddd($result);
        if ($result) {
            throw ValidationException::withMessages(['start_working' => ['未だ休憩を開始していません。'],]);
        }
    }
}
