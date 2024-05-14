<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LocationsOptionsSheet implements WithTitle, WithHeadings, FromArray, ShouldAutoSize, WithEvents
{
    private $regions;
    private $provinces;
    private $cities;
    private $barangays;

    public function __construct()
    {
        $this->regions = json_decode(file_get_contents(resource_path('json/region.json')), true);
        $this->provinces = json_decode(file_get_contents(resource_path('json/province.json')), true);
        $this->cities = json_decode(file_get_contents(resource_path('json/brgy.json')), true);
        $this->barangays = json_decode(file_get_contents(resource_path('json/city.json')), true);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:D1'; 
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
            },
        ];
    }

    public function title(): string
    {
        return 'LocationsOptions';
    }

    public function array(): array
    {
        $data = array();
        foreach($this->regions['RECORDS'] as $key => $value){
            $data[0][] = array($value['regDesc']);
        }
        $counter = 0;
        foreach($this->provinces['RECORDS'] as $key => $value){
            if(isset($data[0][$counter])){
                $data[0][$counter][] = $value['provDesc'];
            }else{
                $data[0][] = array('', $value['provDesc']);
            }
            $counter++;
        }
        $counter = 0;
        foreach($this->cities['RECORDS'] as $key => $value){
            if(isset($data[0][$counter]) && count($data[0][$counter]) > 2){
                $data[0][$counter][] = $value['provDesc'];
            }
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Regions',
            'Provinces'
        ];
    }


}