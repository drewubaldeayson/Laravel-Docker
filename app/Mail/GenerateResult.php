<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\BookingResult;

class GenerateResult extends Mailable
{
    use Queueable, SerializesModels;

    public $result;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BookingResult $result)
    {
        $this->result = $result;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your TPSN Testing Result')
                    ->markdown('emails.result.generated');
    }
}
