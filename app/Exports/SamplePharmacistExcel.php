<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SamplePharmacistExcel implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    public function headings(): array
    {
        return [
            'Name',
            'Father Name',
            'Aadhaar Number',
            'Date Of Birth',
            'Gender',
            'Mobile Number',
            'Email Id',
            'Present Address Line',
            'Present District',
            'Present Pincode',
            'Present State',
            'Present Police Station',
            'Permanent Address Line',
            'Permanent District',
            'Permanent Pincode',
            'Permanent State',
            'Permanent Police Station',
            'Registration Number',
            'Date Of Registration',
            'Valid Upto',
            'Qualification Name',
            'Month Year Of Degree',
            'College Name',
            'Additional Qualification Name',
            'Additional Month Year Of Degree',
            'Additional College Name',
            'Field 1',
            'Field 2',
            'Field 3',
            'Field 4',
        ];
    }

    public function array(): array
    {
        return []; // No sample data
    }

    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle('A1:AD1')->applyFromArray([
            'font' => ['bold' => true, 'name' => 'Arial', 'size' => 10],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(20);
        $sheet->freezePane('A2');
    }

    public function columnWidths(): array
    {
        $cols = range('A', 'AD');
        return array_fill_keys($cols, 29);
    }
}
