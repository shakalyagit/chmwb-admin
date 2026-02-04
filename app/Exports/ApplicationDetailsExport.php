<?php

namespace App\Exports;

use App\Models\ApplicationHead;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ApplicationDetailsExport implements FromQuery, WithHeadings, WithMapping, WithEvents
{
    protected $filters;
    private $rowCount = 0;

    // Reason labels mapping
    private $reasonLabels = [
        'change-surname' => 'Change of Surname',
        'change-address' => 'Change of Address',
        'duplicate-cert' => 'Duplicate Certificate',
        'retention-reg' => 'Retention of Registration',
        'additional-qual' => 'Additional Qualification',
        'cancel-reg' => 'Cancellation of Registration',
        'doctor-id' => 'Doctor\'s ID Card',
        'provisional-reg' => 'Provisional Registration',
    ];

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = ApplicationHead::query()->with(['details', 'reasons']);

        // Apply filters
        if (!empty($this->filters['fromDate'])) {
            $query->whereDate('created_at', '>=', $this->filters['fromDate']);
        }

        if (!empty($this->filters['toDate'])) {
            $query->whereDate('created_at', '<=', $this->filters['toDate']);
        }

        if (!empty($this->filters['searchNumber'])) {
            $query->where('reference_id', 'like', '%' . $this->filters['searchNumber'] . '%');
        }

        if (!empty($this->filters['searchStatus'])) {
            $query->where('status', $this->filters['searchStatus']);
        }

        if (!empty($this->filters['searchRegNumber'])) {
            $searchRegNumber = $this->filters['searchRegNumber'];
            $query->whereHas('details', function ($q) use ($searchRegNumber) {
                $q->where('reg_number', 'like', '%' . $searchRegNumber . '%');
            });
        }

        if (!empty($this->filters['searchAadhaar'])) {
            $searchAadhaar = $this->filters['searchAadhaar'];
            $query->whereHas('details', function ($q) use ($searchAadhaar) {
                $q->where('aadhaar', 'like', '%' . $searchAadhaar . '%');
            });
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'SL No.',
            'ID',
            'Reference ID',
            'Registration Number',
            'Registration Date',
            'Name',
            'Address',
            'Father Name',
            'Qualification',
            'Mobile',
            'Email',
            'Aadhaar',
            'Date of Birth',
            'Blood Group',
            'Held In',
            'University',
            'College',
            'District',
            'Pincode',
            'Police Station',
            'Reasons',
            'Status',
            'Created At',
        ];
    }

    public function map($applicationHead): array
    {
        // Get first detail record (if exists)
        $detail = $applicationHead->details;

        // Get all reasons and convert to readable labels
        $reasonsArray = [];
        foreach ($applicationHead->reasons as $reason) {
            if (!empty($reason->reason_id)) {
                $reasonsArray[] = $this->reasonLabels[$reason->reason_id] ?? $reason->reason_id;
            }
        }
        $reasons = implode(', ', $reasonsArray);

        $this->rowCount++;

        return [
            $this->rowCount, // SL No.
            $applicationHead->id, // ID
            $applicationHead->reference_id ?? '', // Reference ID
            $detail->reg_number ?? '', // Registration Number
            $detail->reg_date ?? '', // Registration Date
            $detail->name ?? '', // Name
            $detail->address ?? '', // Address
            $detail->father_name ?? '', // Father Name
            $detail->qualification ?? '', // Qualification
            $detail->mobile ?? '', // Mobile
            $detail->email ?? '', // Email
            $detail->aadhaar ?? '', // Aadhaar
            $detail->dob ? $detail->dob->format('Y-m-d') : '', // Date of Birth
            $detail->blood_group ?? '', // Blood Group
            $detail->held_in ?? '', // Held In
            $detail->university ?? '', // University
            $detail->college ?? '', // College
            $detail->district ?? '', // District
            $detail->pincode ?? '', // Pincode
            $detail->police_station ?? '', // Police Station
            $reasons, // Reasons
            $applicationHead->status ?? '', // Status
            $applicationHead->created_at ? $applicationHead->created_at->format('Y-m-d H:i:s') : '', // Created At
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Add title and date at the top
                $event->sheet->getDelegate()->insertNewRowBefore(1, 2);

                $event->sheet->getStyle('A1:V2')->getFont()->setName('Arial');
                // Set title
                $event->sheet->setCellValue('A1', 'All Application Details');
                $event->sheet->mergeCells('A1:V1');
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Set date
                $event->sheet->setCellValue('A2', 'Date: ' . date('d-m-Y'));
                $event->sheet->mergeCells('A2:V2');
                $event->sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Make header bold (row 3 after inserting 2 rows)
                $event->sheet->getStyle('A3:V3')->getFont()->setBold(true);
                $event->sheet->getStyle('A3:V3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Auto-size columns
                foreach(range('A','V') as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
