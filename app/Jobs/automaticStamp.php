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


class automaticStamp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     //日付が変わった後に打刻される前提で書いている。
            //->/*subDay()が必*/要か試す
            //Carbonの値確認
    public function __construct()
    {
        $now = Carbon::now();
        $this->now = $now;
        $workNotEnd = Attendance::where('date', $now->/*subDay()->*/format('Y:m:d'))->whereNotNull('end_working')->where('id_u', Auth::id())->doesntExist();

        if($workNotEnd){
            $this->workNotEnd = $workNotEnd;

            $lastStartBreak = Rest::where('date', $now->/*subDay()->*/format('Y:m:d'))->where('id_u', Auth::id())->whereNotNull('start_break')->max('start_break');
            $lastEndBreak = Rest::where('date', $now->/*subDay()->*/format('Y:m:d'))->where('id_u', Auth::id())->whereNotNull('end_break')->max('end_break');

            $breakNotEnd = $lastStartBreak <= $lastEndBreak;

            if ($breakNotEnd) {
                $this->breakNotEnd = $breakNotEnd;
            }
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->workNotEnd) {
            $this->workStamp();

            if ($this->breakNotEnd) {
                $this->breakStamp();
            }
        }
    }

    public function workStamp()
    {
        Attendance::create([
            'date' => $this->now->/*subDay()->*/format('Y-m-d'),
            'end_working' => $this->now->format('Y-m-d H:i:s')/*  . '00:00:00' */,
            'id_u' => Auth::id()
        ]);

        Attendance::create([
            'date' => $this->now->format('Y-m-d'),
            'start_working' => $this->now->format('Y-m-d H:i:s')/*  . '00:00:00' */,
            'id_u' => Auth::id()
        ]);
    }

    public function breakStamp()
    {
        Rest::create([
            //->/*subDay()が必*/要か試す
            'date' => $this->now->/*subDay()->*/format('Y-m-d'),
            //->addDay()をはさむ必要があるか試して考える
            'end_break' => $this->now->format('Y-m-d H:i:s')/*  . '00:00:00' */,
            'id_u' => Auth::id()
        ]);

        Rest::create([
            'date' => $this->now->format('Y-m-d'),
            'start_break' => $this->now->format('Y-m-d H:i:s')/*  . '00:00:00' */,
            'id_u' => Auth::id()
        ]);
    }
}
