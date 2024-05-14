<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;
use App\Mail\GenerateResult;
use App\Models\BookingResult;
use Log;

class SendGenerateResultEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $result;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BookingResult $result)
    {
        $this->result = $result;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // $recipient = 'drey01814@gmail.com';
        // Mail::to($recipient)->send(new GenerateResult($this->result));
        // Log::info('Emailed generated result ' . $this->result->booking_result_id);

        Redis::throttle('mail-sendgrid')->allow(300)->every(60)->then(function () {
            
            $recipient = $this->result->email;
            Mail::to($recipient)->send(new GenerateResult($this->result));
            Log::info('Emailed generated result ' . $this->result->booking_result_id);

        }, function () {
            // Could not obtain lock; this job will be re-queued
            return $this->release(300);
        });

    }
}
