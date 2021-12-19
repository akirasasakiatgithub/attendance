<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AdjustAttendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    public function adjustAtte()
    {
        $dt = new Carbon();
        $stamps = User::select('start_working','end_working', 'start_break', 'end_break')->whereDate('created_at', $dt->toDateString())->distinct()->get();

        //whereDate('created_at'での取得インスタンスにid_u作成（新規登録）のものが混じってはいけないのでid_uは後で追加
        //stampsインスタンスに対応するレコードのid_uのみ追加しているという前提
        $stampsWithId = $stamps->addSelect('id_u')->get();

        //userIdのリストをつくる
        /*foreach ($stampsWithId as $stampWithId) {
            ('start_working')
            //配列またはobjectが入っている
            $id_u = $stampWithId->id->oldest('start_working')->groupBy('id_u');
        }*/

        //for ($i = 0; $i < count($id_u); $i++) {
        foreach ($stampsWithId as $user) {
        //同じユーザーのスタンプを集める
        //ユーザーを勤務開始時間順に並べるようなのでoledest
        $personalStamps = $stampsWithId->oldest('start_working')->where('id_u', $user->id)->toTimeString()->get();
        $startWorking = $personalStamps->start_working;
        $endWorking = $personalStamps->end_working;
        //秒で記録
        $workingTime = $startWorking->diffInSeconds($endWorking);
        //配列またはobjectが入っている→エラーなら配列に直す
        $startBreakSet = $personalStamps->pluck('start_break')->oldest();
        $endBreakSet = $personalStamps->pluck('end_break')->oldest();
        //休憩の合計を求める
        $breakSum = Carbon::parse('00:00:00');
            for ($b = 0; $b< count($startBreakSet); $b++) {
                /*$startBreakSum = $startBreakSum->addSecond(date('s', $endBreakSet[$s]))->format('d H:i:s');*/
    
                //$startBreakSet[$s]がCarbon取得でないのでdiffINが使えないとか言って来たらCarbon::parseでCarbonに直す
                $breakSum = $breakSum->addSecond($startBreakSet[$b]->diffInSeconds($endBreakSet[$b]));
            }
            /*$activeWorkingSum = $breakSum->diffInSeconds($workingTime)->format('H:i:s');*/
            $activeWorkingSum = $workingTime->subSecond($breakSum);
        }
        
    }
}
