<?php

namespace App\Imports;

use App\Models\Practioner;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PractitionersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row)
    {
        return new Practioner([
            'registration_no' => $row['registration_no'] ?? null,
            'registration_date' => isset($row['registration_date'])
                ? Date::excelToDateTimeObject($row['registration_date'])->format('Y-m-d')
                : null,
            'name'            => $row['name'] ?? null,
            'fathers_name'    => $row['fathers_name'] ?? null,
            'address'         => $row['address'] ?? null,
            'district'        => $row['district'] ?? null,
            'state'           => $row['state'] ?? null,
            'pincode'         => $row['pincode'] ?? null,
            'ph_no'           => $row['ph_no'] ?? null,
            'email_id'        => $row['email_id'] ?? null,
            'qualification'   => $row['qualification'] ?? null,
            'part'            => $row['part'] ?? null,
            'status'          => $row['status'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.registration_no' => [
                'required',
                'distinct',
                Rule::unique('practioners', 'registration_no'),
            ],
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '*.registration_no' => 'registration number',
        ];
    }
}