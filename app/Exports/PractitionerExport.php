<?php

namespace App\Exports;

use App\Models\Practioner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PractitionerExport implements FromCollection, WithHeadings, WithStyles
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Practioner::query();

        if (!empty($this->request->reg_no)) {
            $query->where('registration_no', 'like', '%' . $this->request->reg_no . '%');
        }

        if (!empty($this->request->to_date)) {
            $query->whereDate('registration_date', $this->request->to_date);
        }

        if (!empty($this->request->name)) {
            $query->where('name', 'like', '%' . $this->request->name . '%');
        }

        if (!empty($this->request->phone)) {
            $query->where('ph_no', 'like', '%' . $this->request->phone . '%');
        }

        return $query->get([
            'registration_no',
            'registration_date',
            'name',
            'fathers_name',
            'address',
            'state',
            'district',
            'pincode',
            'ph_no',
            'email_id',
            'qualification',
            'part',
        ]);
    }

    public function headings(): array
    {
        return [
            'Registration No',
            'Registration Date',
            'Name',
            'Fathers Name',
            'Address',
            'State',
            'District',
            'Pincode',
            'Phone',
            'Email',
            'Qualification',
            'Part',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
