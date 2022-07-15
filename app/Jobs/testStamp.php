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

class testStamp implements ShouldQueue
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
        $now = Carbon::now();
        Rest::create([
            'date' => $now->format('Y-m-d'),
            'start_break' => $now->format('Y-m-d H:i:s'),
            'id_u' => $this->id,
        ]);

        Rest::create([
            'date' => $now->addSecond()->format('Y-m-d'),
            'start_break' => $now->format('Y-m-d H:i:s'),
            'id_u' => Auth::id()
        ]);
    }
}
