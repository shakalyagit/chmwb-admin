<?php

namespace App\Imports;

use App\Models\Practioner;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;

class PractitionersImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    WithEvents
{
    public int $rowsProcessed = 0;

    private array $requiredHeaders = [
        'registration_no',
        'registration_date',
        'name',
        'fathers_name',
        'address',
        'district',
        'state',
        'pincode',
        'ph_no',
        'email_id',
        'qualification',
        'part',
        'status',
    ];

    public function model(array $row)
    {
        if (!array_filter($row)) {
            return null;
        }

        $this->rowsProcessed++;

        return Practioner::updateOrCreate(
            [
                'registration_no' => $row['registration_no'],
            ],
            [
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
            ]
        );
    }

    public function prepareForValidation($data, $index)
    {
        if ($index === 1) {

            $excelHeaders = array_keys($data);

            $missingHeaders = array_diff($this->requiredHeaders, $excelHeaders);

            if (!empty($missingHeaders)) {
                throw new \Exception('Please upload another excel file.');
            }
        }

        return $data;
    }

    public function rules(): array
    {
        return [
            '*.registration_no' => ['required'],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function () {
                if ($this->rowsProcessed === 0) {
                    throw new \Exception('The uploaded Excel file contains no data.');
                }
            },
        ];
    }
}
