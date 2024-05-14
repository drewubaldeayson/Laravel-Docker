<?php

namespace App\Exports;

use App\Exports\Sheets\LocationsOptionsSheet;
use App\Exports\Sheets\AppointmentFormSheet;
use App\Exports\Sheets\ClinicServicesOptionsSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Contracts\ClinicRepositoryInterface;

use JWTAuth;


class BulkAppointmentExport implements WithMultipleSheets
{

    use Exportable;

    protected $data;
    protected $timeslots;
    protected $services;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->timeslots = $data['timeslots'];
        $this->services = $data['services'];
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $services = array();
        $services['event_started'] = $this->data['event_started'];
        $services['event_ended'] = $this->data['event_ended'];
        $services['services'] = $this->services;
        $services['timeslots'] = $this->timeslots;

        $sheets[] = new AppointmentFormSheet($services);
        $sheets[] = new ClinicServicesOptionsSheet($services);
        $sheets[] = new LocationsOptionsSheet();

        return $sheets;
    }

}
