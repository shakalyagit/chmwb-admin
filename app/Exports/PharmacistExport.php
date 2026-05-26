<?php

namespace App\Exports;

use App\Models\Pharmacists;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PharmacistExport implements FromCollection, WithHeadings, WithStyles
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Pharmacists::leftJoin('pharmacy_registrations', 'pharmacy_registrations.pharmacist_id', '=', 'pharmacists.id')
            ->leftJoin('addresses as present', 'present.id', '=', 'pharmacists.present_address_id')
            ->leftJoin('addresses as permanent', 'permanent.id', '=', 'pharmacists.permanent_address_id')
            ->select(
                'pharmacy_registrations.registration_number',
                'pharmacy_registrations.date_of_registration',
                'pharmacy_registrations.valid_upto',
                'pharmacy_registrations.qualification_name',
                'pharmacy_registrations.qualification_held',
                'pharmacy_registrations.qualification_college',
                'pharmacy_registrations.add_qualification_name',
                'pharmacy_registrations.add_qualification_held',
                'pharmacy_registrations.add_qualification_college',
                'pharmacists.name',
                'pharmacists.father_name',
                'pharmacists.aadhaar_number',
                'pharmacists.date_of_birth',
                'pharmacists.gender',
                'pharmacists.mobile_number',
                'pharmacists.email_id',
                'pharmacists.status',
                'pharmacists.field_1',
                'pharmacists.field_2',
                'pharmacists.field_3',
                'pharmacists.field_4',
                'present.address_line as present_address_line',
                'present.district as present_district',
                'present.state as present_state',
                'present.pincode as present_pincode',
                'present.police_station as present_police_station',
                'permanent.address_line as permanent_address_line',
                'permanent.district as permanent_district',
                'permanent.state as permanent_state',
                'permanent.pincode as permanent_pincode',
                'permanent.police_station as permanent_police_station'
            );

        if (!empty($this->request->reg_no)) {
            $query->where('pharmacy_registrations.registration_number', 'like', '%' . $this->request->reg_no . '%');
        }

        if (!empty($this->request->from_date) && !empty($this->request->to_date)) {
            $query->whereBetween('pharmacy_registrations.date_of_registration', [
                $this->request->from_date,
                $this->request->to_date,
            ]);
        }

        if (!empty($this->request->name)) {
            $query->where('pharmacists.name', 'like', '%' . $this->request->name . '%');
        }

        if (!empty($this->request->phone)) {
            $query->where('pharmacists.mobile_number', 'like', '%' . $this->request->phone . '%');
        }

        if (!empty($this->request->status)) {
            $query->where('pharmacists.status', $this->request->status);
        }

        return $query->limit(5000)->get();
    }

    public function headings(): array
    {
        return [
            'Registration Number',
            'Registration Date',
            'Valid Upto',
            'Qualification Name',
            'Qualification Month/Year',
            'Qualification College',
            'Additional Qualification',
            'Additional Qualification Month/Year',
            'Additional Qualification College',
            'Name',
            'Father Name',
            'Aadhaar Number',
            'Date of Birth',
            'Gender',
            'Mobile Number',
            'Email',
            'Status',
            'Field 1',
            'Field 2',
            'Field 3',
            'Field 4',
            'Present Address Line',
            'Present District',
            'Present State',
            'Present Pincode',
            'Present Police Station',
            'Permanent Address Line',
            'Permanent District',
            'Permanent State',
            'Permanent Pincode',
            'Permanent Police Station',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
