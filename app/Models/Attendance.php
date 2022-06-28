<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Rules\CheckAtWork;
use App\Rules\CheckBeforeWork;
use App\Rules\CheckEndBreak;
use App\Rules\CheckNotEndWork;
use App\Rules\CheckStartBreak;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [
        'id_a',
        'created_at',
        'date',
        'start_working',
        'end_working',
    ];

    protected $fillable = [
        'update_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static $rules = array(
        'date' => 'required',
        'id_u' => 'required',
    );

    public function validateBeforeWork(): void
    {
        $now = new Carbon();
        $result = self::query()->where('date', $now->format('Y:m:d'))->whereNotNull('start_working')->where('id_u', Auth::id())->exists();
        if ($result) {
            throw ValidationException::withMessages(['start_working' => ['既に出勤登録しています。'],]);
        }
    }

    public function adjustAttendance($date)
    {
        $dailyAtte = Attendance::where('date', $date)->get();
        $idlist = $dailyAtte->unique('id_u')->pluck('id_u');
        $dataSet = collect([]);

        for ($i = 0; $i < count($idlist); $i++) {
            //$dailyAtteから$idlist[i]でデータを引き出し
            $personAtte = $dailyAtte->where('id_u', $idlist[$i]);
            $startWork = $personAtte->whereNotNull('start_working')->pluck('start_working')->get('0');
            $endWork = $personAtte->whereNotNull('end_working')->pluck('end_working')->get('0');
            $startWork = new Carbon($startWork);
            $endWork = new Carbon($endWork);
            //時間の計算
            //->format('%H:%i:%s')をつけたことで、むしろプロパティとして各単位にアクセスすることができなくなった。多分いらない。
            $workTime = $startWork->diff($endWork)->format('%H:%i:%s');
            $psnData = collect([$idlist[$i], $startWork, $endWork, $workTime]);
            $dataSet->concat([$psnData]);
        }
        return $dataSet;
    }
}
