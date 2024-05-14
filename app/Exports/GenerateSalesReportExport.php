<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

// use Maatwebsite\Excel\Concerns\FromQuery;
// use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use App\Models\Invoice;

class GenerateSalesReportExport implements FromArray, WithHeadings, WithTitle, WithEvents
{

    use Exportable;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(35);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(30);

                $cellRange = 'A1:L1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->getStyle('A1:L1')->getFill()->applyFromArray([
                    'fillType' => 'solid',
                    'color' => ['rgb' => 'D9D9D9'],
                ]);

            },
        ];
    }


    public function array(): array
    {
        $data = $this->data;
        return $data;
    }

    
    public function title(): string
    {
        return 'Sales Report';
    }

    /**
     * Headings
     */
    public function headings(): array
    {
        return [
            '#',
            'Pods',
            'Booking Code',
            'DateTime Paid',
            'Booking Date',
            'Booking Timeslot',
            'Product/Service',
            'Booking Type',
            'Status',
            'Paid Amount',
            'Mode Of Payment',
            'Reference Number'
        ];
    }
}
