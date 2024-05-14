<?php

namespace App\Exports\Sheets;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\NamedRange;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ClinicServicesOptionsSheet implements WithTitle, WithHeadings, FromArray, ShouldAutoSize,
    WithEvents, WithColumnFormatting
{

    private $data;
    private $daterange;
    private $daterangecount;
    private $timeslotsrange;
    private $servicesrange;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:C1'; 
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);

                $timeslot_base_column = 'C';
                foreach($this->daterange as $date){
                    $event->sheet->getDelegate()->getParent()->addNamedRange(
                        new NamedRange($date->format('F_d_Y'), $event->sheet->getDelegate(), '=$'.$timeslot_base_column.'$2:$'.$timeslot_base_column.'$'.($this->timeslotsrange+1))
                    );
                    $timeslot_base_column++;
                }

                $event->sheet->getDelegate()->getParent()->addNamedRange(
                    new NamedRange('DateRange', $event->sheet->getDelegate(), '=$A$2:$A$'.($this->daterangecount+1))
                );

                $event->sheet->getDelegate()->getParent()->addNamedRange(
                    new NamedRange('Services', $event->sheet->getDelegate(), '=$B$2:$B$'.($this->servicesrange+1))
                );
            },
        ];
    }
    

    public function title(): string
    {
        return 'ServicesOptions';
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT
        ];
    }

    public function array(): array
    {
        $data = array();
        $serviceData = $this->data;
        $dateRange = CarbonPeriod::create($serviceData['event_started'], $serviceData['event_ended']);
        $this->daterange = $dateRange->toArray();
        foreach($dateRange->toArray() as $date){
            $data[0][] = array($date->format('F_d_Y'));
        }
        $counter = 0;
        foreach($serviceData['services'] as $service){
            if(isset($data[0][$counter])){
                $data[0][$counter][] = $service['service_name'];
            }else{
                $data[0][] = array('', $service['service_name']);
            }
            $counter++;
        }
        $this->servicesrange = $counter;
        $counter = 0; 
        $column = 0;
        $slot_date = '';
        $tslotsrange = 0;
        $daterangecount = 0;
        foreach($serviceData['timeslots'] as $timeslot){
            if($slot_date != $timeslot['slot_date']){
                $slot_date = $timeslot['slot_date'];
                $column++;
                $counter = 0;
                $daterangecount = $column > $daterangecount? $column: $daterangecount;
            }
            if(isset($data[0][$counter]) && count($data[0][$counter]) == $column){
                for ($i=0; $i < $column; $i++) { 
                    $data[0][$counter][] = '';
                }
                $data[0][$counter][] = $timeslot['slot_start'].' - '.$timeslot['slot_end'].' (slot available: '.$timeslot['slot_available'].')';
            }else if(isset($data[0][$counter]) && count($data[0][$counter]) == 2){
                $data[0][$counter][] = $timeslot['slot_start'].' - '.$timeslot['slot_end'].' (slot available: '.$timeslot['slot_available'].')';
            }else{
                $data[0][$counter][] = $timeslot['slot_start'].' - '.$timeslot['slot_end'].' (slot available: '.$timeslot['slot_available'].')';
            }
            $counter++;
            $tslotsrange = $counter > $tslotsrange? $counter: $tslotsrange;
        }

        $this->timeslotsrange = $tslotsrange;
        $this->daterangecount = $daterangecount;

        return $data;
    }

    public function headings(): array
    {
        return [
            'DateRange',
            'Services',
            'Timeslots',
        ];
    }


}