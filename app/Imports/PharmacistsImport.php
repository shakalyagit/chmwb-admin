<?php

namespace App\Imports;

use App\Models\Address;
use App\Models\Pharmacists;
use App\Models\PharmacyRegistration;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class PharmacistsImport implements ToCollection, WithHeadingRow
{
    private $rowCount = 0;
    private $skipCount = 0;
    private $importedCount = 0;
    private $errors = [];

    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row) {
            $this->rowCount++;

            // Validate registration_number
            if (empty($row['registration_number'] ?? null)) {
                $this->skipCount++;
                $this->errors[] = "Row {$this->rowCount}: The registration number field is required.";
                Log::warning('Skipping row ' . $this->rowCount . ': Missing registration_number');
                continue; // ← was `return`, which exited the entire method
            }

            // Validate date_of_registration
            if (empty($row['date_of_registration'] ?? null)) {
                $this->skipCount++;
                $this->errors[] = "Row {$this->rowCount} (Registration: {$row['registration_number']}): The date of registration field is required.";
                Log::warning('Skipping row ' . $this->rowCount . ': Missing registration_date. Registration: ' . $row['registration_number']);
                continue; // ← was `return`, which exited the entire method
            }

            $dateOfBirth        = $this->convertDate($row['date_of_birth'] ?? null);
            $dateOfRegistration = $this->convertDate($row['date_of_registration'] ?? null);
            $validUpto          = $this->convertDate($row['valid_upto'] ?? null);

            DB::transaction(function () use ($row, $dateOfBirth, $dateOfRegistration, $validUpto) {
                $existingRegistration = PharmacyRegistration::where(
                    'registration_number',
                    $row['registration_number']
                )->first();

                if ($existingRegistration) {
                    Log::info('Updating pharmacist: ' . $row['registration_number']);
                    $pharmacist = Pharmacists::find($existingRegistration->id);

                    if (!$pharmacist) {
                        throw new Exception("Pharmacist not found for registration: {$row['registration_number']}");
                    }

                    // Update present address
                    $presentAddress                 = Address::find($pharmacist->present_address_id);
                    if (!$presentAddress) {
                        throw new Exception("Present address not found for pharmacist: {$pharmacist->id}");
                    }
                    $presentAddress->address_line   = $row['present_address_line'] ?? null;
                    $presentAddress->district       = $row['present_district'] ?? null;
                    $presentAddress->pincode        = $row['present_pincode'] ?? null;
                    $presentAddress->state          = $row['present_state'] ?? null;
                    $presentAddress->police_station = $row['present_police_station'] ?? null;
                    $presentAddress->save();

                    // Update permanent address
                    $permanentAddress                 = Address::find($pharmacist->permanent_address_id);
                    if (!$permanentAddress) {
                        throw new Exception("Permanent address not found for pharmacist: {$pharmacist->id}");
                    }
                    $permanentAddress->address_line   = $row['permanent_address_line'] ?? null;
                    $permanentAddress->district       = $row['permanent_district'] ?? null;
                    $permanentAddress->pincode        = $row['permanent_pincode'] ?? null;
                    $permanentAddress->state          = $row['permanent_state'] ?? null;
                    $permanentAddress->police_station = $row['permanent_police_station'] ?? null;
                    $permanentAddress->save();

                    // Update pharmacist
                    $pharmacist->name                 = $row['name'] ?? null;
                    $pharmacist->father_name          = $row['father_name'] ?? null;
                    $pharmacist->aadhaar_number       = $row['aadhaar_number'] ?? null;
                    $pharmacist->date_of_birth        = $dateOfBirth;
                    $pharmacist->gender               = $row['gender'] ?? null;
                    $pharmacist->mobile_number        = $row['mobile_number'] ?? null;
                    $pharmacist->email_id             = $row['email_id'] ?? null;
                    $pharmacist->status               = $row['status'] ?? 'Active';
                    $pharmacist->field_1              = $row['field_1'] ?? null;
                    $pharmacist->field_2              = $row['field_2'] ?? null;
                    $pharmacist->field_3              = $row['field_3'] ?? null;
                    $pharmacist->field_4              = $row['field_4'] ?? null;
                    $pharmacist->save();

                    // Update registration
                    $existingRegistration->date_of_registration = $dateOfRegistration;
                    $existingRegistration->valid_upto           = $validUpto;
                    $existingRegistration->qualification_name   = $row['qualification_name'] ?? null;
                    $existingRegistration->qualification_held   = $row['month_year_of_degree'] ?? null;
                    $existingRegistration->qualification_college = $row['college_name'] ?? null;
                    $existingRegistration->add_qualification_name   = !empty($row['additional_qualification_name']) ? $row['additional_qualification_name'] : null;
                    $existingRegistration->add_qualification_held   = !empty($row['additional_month_year_of_degree']) ? $row['additional_month_year_of_degree'] : null;
                    $existingRegistration->add_qualification_college = !empty($row['additional_college_name']) ? $row['additional_college_name'] : null;
                    $existingRegistration->save();
                    $this->importedCount++;
                } else {
                    Log::info('Creating new pharmacist: ' . $row['registration_number']);
                    // Step 1 — Present address
                    $presentAddress                 = new Address();
                    $presentAddress->address_line   = $row['present_address_line'] ?? null;
                    $presentAddress->district       = $row['present_district'] ?? null;
                    $presentAddress->pincode        = $row['present_pincode'] ?? null;
                    $presentAddress->state          = $row['present_state'] ?? null;
                    $presentAddress->police_station = $row['present_police_station'] ?? null;
                    $presentAddress->save();

                    // Step 2 — Permanent address
                    $permanentAddress                 = new Address();
                    $permanentAddress->address_line   = $row['permanent_address_line'] ?? null;
                    $permanentAddress->district       = $row['permanent_district'] ?? null;
                    $permanentAddress->pincode        = $row['permanent_pincode'] ?? null;
                    $permanentAddress->state          = $row['permanent_state'] ?? null;
                    $permanentAddress->police_station = $row['permanent_police_station'] ?? null;
                    $permanentAddress->save();

                    // Step 3 — Pharmacist
                    $pharmacist                       = new Pharmacists();
                    $pharmacist->name                 = $row['name'] ?? null;
                    $pharmacist->father_name          = $row['father_name'] ?? null;
                    $pharmacist->aadhaar_number       = $row['aadhaar_number'] ?? null;
                    $pharmacist->date_of_birth        = $dateOfBirth;
                    $pharmacist->gender               = $row['gender'] ?? null;
                    $pharmacist->mobile_number        = $row['mobile_number'] ?? null;
                    $pharmacist->email_id             = $row['email_id'] ?? null;
                    $pharmacist->present_address_id   = $presentAddress->id;
                    $pharmacist->permanent_address_id = $permanentAddress->id;
                    $pharmacist->field_1              = $row['field_1'] ?? null;
                    $pharmacist->field_2              = $row['field_2'] ?? null;
                    $pharmacist->field_3              = $row['field_3'] ?? null;
                    $pharmacist->field_4              = $row['field_4'] ?? null;
                    $pharmacist->save();

                    // Step 4 — Registration
                    $registration                       = new PharmacyRegistration();
                    $registration->pharmacist_id        = $pharmacist->id;
                    $registration->registration_number  = $row['registration_number'] ?? null;
                    $registration->date_of_registration = $dateOfRegistration;
                    $registration->valid_upto           = $validUpto;
                    $registration->qualification_name   = $row['qualification_name'] ?? null;
                    $registration->qualification_held   = $row['month_year_of_degree'] ?? null;
                    $registration->qualification_college = $row['college_name'] ?? null;

                    // Step 5 — Additional qualification (if present)
                    if (!empty($row['additional_qualification'])) {
                        $registration->add_qualification_name   = $row['additional_qualification_name'];
                        $registration->add_qualification_held   = $row['additional_month_year_of_degree'] ?? null;
                        $registration->add_qualification_college = $row['additional_college_name'] ?? null;
                    }

                    $registration->save();
                    $this->importedCount++;
                }
            });
        }

        Log::info("Import complete - Total rows: {$this->rowCount}, Imported: {$this->importedCount}, Skipped: {$this->skipCount}");
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    private function convertDate($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        // If it's a numeric Excel serial number
        if (is_numeric($value)) {
            return Carbon::instance(ExcelDate::excelToDateTimeObject($value))->format('Y-m-d');
        }

        // Try Y-m-d format first (1996-10-08)
        try {
            return Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d');
        } catch (Exception $e) {
            // Fall back to d/m/Y format (15/08/1990 or 15-08-1990)
            try {
                return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            } catch (Exception $e) {
                return null;
            }
        }
    }
}
