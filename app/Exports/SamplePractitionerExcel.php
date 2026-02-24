<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SamplePractitionerExcel implements FromArray, WithHeadings, WithStyles
{
    public function array(): array
    {
        return [];
    }

    public function headings(): array
    {
        return [
            'Registration No',
            'Registration Date',
            'Name',
            'Fathers Name',
            'Address',
            'District',
            'State',
            'Pincode',
            'Ph No',
            'Email Id',
            'Qualification',
            'Part',
            'Status',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], 
        ];
    }
}