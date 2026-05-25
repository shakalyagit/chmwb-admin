<?php

namespace App\Imports;

use App\Models\Practioner;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
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
    WithEvents,
    SkipsEmptyRows
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
                'registration_date' => $this->convertDate($row['registration_date'] ?? null),
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
            ]
        );
    }

    public function prepareForValidation($data, $index)
    {
        if ($index > 1) {
        $hasAnyRawData = false;
        foreach ($data as $key => $value) {
            if ($value !== null && $value !== '') {
                $hasAnyRawData = true;
                \Log::info("Row $index has raw data", [
                    'key' => $key,
                    'value' => $value,
                    'type' => gettype($value),
                    'hex' => bin2hex((string) $value),
                ]);
            }
        }
        if (!$hasAnyRawData) {
            \Log::info("Row $index is completely null/empty — will be skipped");
        }
    }

        // Aggressively clean a cell value — handles normal spaces, non-breaking
        // spaces (\xA0), zero-width chars, and hidden HTML from Excel.
        $clean = function ($value): string {
            $str = strip_tags((string) ($value ?? ''));
            // Remove non-breaking spaces and other unicode whitespace
            $str = preg_replace('/[\x00-\x1F\x7F\xA0\x{200B}-\x{200D}\x{FEFF}]/u', '', $str);
            return trim($str);
        };

        $registrationNo = $clean($data['registration_no'] ?? '');

        // Check if any column other than registration_no has real data
        $hasOtherData = false;
        foreach ($data as $key => $value) {
            if ($key === 'registration_no') continue;
            if ($clean($value) !== '') {
                $hasOtherData = true;
                break;
            }
        }

        // Completely empty row — skip silently
        if ($registrationNo === '' && !$hasOtherData) {
            return [];
        }

        // Has other data but no registration_no — let validation report it
        return $data;
    }

    public function rules(): array
    {
        return [
            '*.registration_no' => ['required'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            '*.registration_no.required' => 'Registration No is missing.',
        ];
    }

    private function convertDate($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        if (is_numeric($value)) {
            return Carbon::instance(Date::excelToDateTimeObject($value))->format('Y-m-d');
        }

        $value = trim((string) $value);

        $formats = [
            'Y-m-d',
            'Y/m/d',
            'Y.m.d',
            'd/m/Y',
            'd-m-Y',
            'd.m.Y',
            'd M Y',
            'd F Y',
        ];

        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, $value)->format('Y-m-d');
            } catch (\Exception $e) {
                // continue trying next format
            }
        }

        return null;
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
