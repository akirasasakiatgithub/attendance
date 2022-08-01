<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\Rest;
use Carbon\Carbon;

class testStampJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function __invoke()
    {
        $this->handle();
    }

    public function handle()
    {
        //休憩時間記録用のモデルに休憩開始時刻を打刻
        $now = Carbon::now();
        Rest::create([
            'date' => $now->format('Y-m-d'),
            'start_break' => $now->format('Y-m-d H:i:s'),
            'user_id' => $this->id,
        ]);

        //開始時刻に1秒加えて休憩終了時刻を打刻
        Rest::create([
            'date' => $now->addSecond()->format('Y-m-d'),
            'end_break' => $now->format('Y-m-d H:i:s'),
            'user_id' => $this->id,
        ]);
    }
}
