<?php

namespace App\Exports\Sheets;

use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AppointmentFormSheet implements WithTitle, WithHeadings, FromArray, WithEvents, WithColumnWidths, WithColumnFormatting
{
    
    private $data;
    private $daterange;
    private $rowcount = 102;

    public function __construct($data)
    {
        $this->data = $data;
        $serviceData = $data;
        $dateRange = CarbonPeriod::create($serviceData['event_started'], $serviceData['event_ended']);
        $this->daterange = $dateRange->toArray();
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 35,
            'D' => 25,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 10,
            'I' => 15,
            'J' => 45,
            'K' => 15,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 10,
            'Q' => 30
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(35);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(15);

                $cellRange = 'A1:Q1'; 
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->getStyle('A1:Q1')->getFill()->applyFromArray([
                    'fillType' => 'solid',
                    'color' => ['rgb' => 'D9D9D9'],
                ]);

                $drop_column = 'B';
 
                // set dropdown list for first data row
                $validation = $event->sheet->getCell("{$drop_column}3")->getDataValidation();
                $validation->setType(DataValidation::TYPE_LIST );
                $validation->setErrorStyle(DataValidation::STYLE_INFORMATION );
                $validation->setAllowBlank(false);
                $validation->setShowInputMessage(true);
                $validation->setShowErrorMessage(true);
                $validation->setShowDropDown(true);
                $validation->setErrorTitle('Input error');
                $validation->setError('Value is not in list.');
                $validation->setPromptTitle('Pick from list');
                $validation->setPrompt('Please pick a value from the drop-down list.');
                $validation->setFormula1('DateRange');

                // clone validation to remaining rows
                for ($i = 3; $i <= $this->rowcount; $i++) {
                    $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                }

                $drop_column2 = 'C';
                $validation2 = $event->sheet->getCell("{$drop_column2}3")->getDataValidation();
                $validation2->setType(DataValidation::TYPE_LIST );
                $validation2->setErrorStyle(DataValidation::STYLE_INFORMATION );
                $validation2->setAllowBlank(false);
                $validation2->setShowInputMessage(true);
                $validation2->setShowErrorMessage(true);
                $validation2->setShowDropDown(true);
                $validation2->setErrorTitle('Input error');
                $validation2->setError('Value is not in list.');
                $validation2->setPromptTitle('Pick from list');
                $validation2->setPrompt('Please pick a value from the Booking Date before to populate list.');
                $validation2->setFormula1("=INDIRECT(B3)");

                for ($i = 3; $i <= $this->rowcount; $i++) {
                    $event->sheet->getCell("{$drop_column2}{$i}")->setDataValidation(clone $validation2);
                }

                $drop_column3 = 'D';
                $validation3 = $event->sheet->getCell("{$drop_column3}3")->getDataValidation();
                $validation3->setType(DataValidation::TYPE_LIST );
                $validation3->setErrorStyle(DataValidation::STYLE_INFORMATION );
                $validation3->setAllowBlank(false);
                $validation3->setShowInputMessage(true);
                $validation3->setShowErrorMessage(true);
                $validation3->setShowDropDown(true);
                $validation3->setErrorTitle('Input error');
                $validation3->setError('Value is not in list.');
                $validation3->setPromptTitle('Pick from list');
                $validation3->setPrompt('Please pick a value from the drop-down list.');
                $validation3->setFormula1("Services");

                for ($i = 3; $i <= $this->rowcount; $i++) {
                    $event->sheet->getCell("{$drop_column3}{$i}")->setDataValidation(clone $validation3);
                }

            },
        ];
    }

    public function array(): array
    {
        $data = array();
        for ($i=0; $i <= 100; $i++) { 
            $data[] = array($i);
        }
        return $data;
    }

    public function title(): string
    {
        return 'FormSheet';
    }

    public function headings(): array
    {
        return [
            'ID',
            'Booking Date',
            'Booking Timeslot',
            'Services',
            'Firstname',
            'Middlename',
            'Lastname',
            'Gender',
            'Date-Of-Birth',
            'Email address',
            'Contact number',
            'Region',
            'Province',
            'City',
            'Barangay',
            'Zip Code',
            'Address (House No./Unit No./Street)',
        ];
    }

}