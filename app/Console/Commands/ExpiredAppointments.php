<?php

namespace App\Console\Commands;

use App\Contracts\AppointmentInterface;
use App\Contracts\InvoiceInterface;

use Illuminate\Console\Command;

class ExpiredAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:appoinments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Appointment will expire within 30 mins after it is created';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(
        AppointmentInterface $appointment,
        InvoiceInterface $invoice
    )
    {
        $appointments = $appointment->getPendingAppointments();
        foreach ($appointments as $key => $value) {
            $appointment->update($value->booking_order_id,['booking_status' => 5]);
            if ($value->invoice_id != null) {
                $invoice->update($value->invoice_id,['invoice_status' => 'overdue']);
            }
        }

        return Command::SUCCESS;
    }
}
