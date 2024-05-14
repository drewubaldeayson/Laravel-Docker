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
use App\Mail\AppointmentCode;
use App\Models\BookingOrder;
use Log;

class SendAppointmentCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::throttle('mail-sendgrid')->allow(300)->every(60)->then(function () {
            
            $recipient = $this->order['email'];
            Mail::to($recipient)->send(new AppointmentCode($this->order));
            Log::info('Emailed appointment code sent ' . $this->order['booking_code']);

        }, function () {
            // Could not obtain lock; this job will be re-queued
            return $this->release(300);
        });
    }
}
