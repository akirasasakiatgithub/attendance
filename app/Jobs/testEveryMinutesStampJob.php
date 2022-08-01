<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Rest;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class testEveryMinutesStampJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    //日付が変わる前に仕事が終わっていない人のuser_idの配列が入る
    private $workNotEndIds;

    private $breakNotEndIds;

    //日付が変わった後に打刻される前提で書いている。
    //->/*subDay()が必*/要か試す
    //Carbonの値確認
    public function __construct()
    {
        $now = Carbon::now();
        $this->now = $now;
        $atteIds = Attendance::where('date', $now->format('Y:m:d'))->pluck('user_id');
        $workEndIds = Attendance::where('date', $now->format('Y:m:d'))->whereNotNull('end_working')->pluck('user_id');
        $workNotEndIds = $atteIds->diff($workEndIds);

        if ($workNotEndIds) {
            //$workNotEndIdsは配列
            $this->workNotEndIds = $workNotEndIds;

            $breakNotEndIds = [];

            foreach ($this->workNotEndIds as $userId) {

                $startBreak = Rest::where('date', $now->format('Y:m:d'))->where('user_id', $userId)->whereNotNull('start_break')->get();

                $endBreak = Rest::where('date', $now->format('Y:m:d'))->where('user_id', $userId)->whereNotNull('end_break')->get();

                $sBNum = count($startBreak);
                $eBNum = count($endBreak);

                if (!($sBNum == $eBNum)) {
                    $breakNotEndIds = $userId;
                }
            }
            $this->breakNotEndIds = $breakNotEndIds;
        }
    }

    public function __invoke()
    {
        $this->handle();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->workNotEndIds) {

            $this->endStamp();
            $this->startStamp();
        }
        $this->workNotEndIds = null;
        $this->breakNotEndIds = null;
    }

    public function endStamp()
    {
        if ($this->breakNotEndIds) {

            foreach ($this->breakNotEndIds as $userId) {
                Rest::create([
                    //->/*subDay()が必*/要か試す
                    'date' => $this->now->format('Y-m-d'),
                    //->addDay()をはさむ必要があるか試して考える
                    'end_break' => $this->now->format('Y-m-d H:i:s') /*  . '23:59:59' */,
                    'user_id' => $userId,
                ]);
            }
        }

        foreach ($this->workNotEndIds as $userId) {
            Attendance::create([
                'date' => $this->now->format('Y-m-d'),
                'end_working' => $this->now->format('Y-m-d H:i:s')/*  . '23:59:59' */,
                'user_id' => $userId,
            ]);
        }
    }

    public function startStamp()
    {
        foreach ($this->workNotEndIds as $userId) {
            Attendance::create([
                'date' => $this->now->format('Y-m-d'),
                'start_working' => $this->now->format('Y-m-d H:i:s')/*   . '00:00:00' */,
                'user_id' => $userId,
            ]);
        }

        if ($this->breakNotEndIds) {

            foreach ($this->breakNotEndIds as $userId) {
                Rest::create([
                    'date' => $this->now->format('Y-m-d'),
                    'start_break' => $this->now->format('Y-m-d H:i:s')/*   . '00:00:00' */,
                    'user_id' => $userId,
                ]);
            }
        }
    }
}
