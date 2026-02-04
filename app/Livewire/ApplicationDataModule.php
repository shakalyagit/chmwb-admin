<?php

namespace App\Livewire;

use App\Exports\ApplicationDetailsExport;
use App\Models\ApplicationHead;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ApplicationDetail;
use App\Models\ApplicationMedia;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationStatusUpdated;
use App\Mail\ApplicationStatusApprovedEmail;
use Illuminate\Support\Facades\Log;

class ApplicationDataModule extends Component
{
    use WithPagination;
    use WithFileUploads;

    // View management
    public string $mode = 'list'; // 'list', 'view', 'edit'

    // Filters
    public $fromDate = '';
    public $toDate = '';
    public $searchNumber = ''; // Corresponds to reference_id
    public $searchRegNumber = '';
    public $searchAadhaar = '';
    public $searchStatus = '';
    public $searchReason = '';
    public $status_reason;

    // Data properties
    public $selectedApplication;
    public $newStatus = '';

    // Edit mode properties
    public $editDetails = [];
    public $newMedia = [];
    public $uploadDocumentType = '';
    public $uploadFile;
    public $documentTypes = [
        'studentRegCert', 'signature', 'regCert', 'principalDeclaration', 'photo', 'paymentProof', 'mdCertificate', 'marriageCert', 'marksheet', 'internshipCert', 'finalMarksheet', 'dobProof', 'classXIIMarksheet', 'bhmsMarksheets', 'additionalQualCert', 'aadhaar'
    ];

    public $excel_downloading = false;

    // For displaying reason labels
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

    protected $paginationTheme = 'bootstrap';

    public function getReasonLabel(string $reasonId): string
    {
        return $this->reasonLabels[$reasonId] ?? 'Unknown Reason';
    }

    // View navigation methods
    public function viewApplication($id)
    {
        $this->selectedApplication = ApplicationHead::with(['details', 'reasons', 'media'])->findOrFail($id);
        $this->newStatus = $this->selectedApplication->status;
        $this->status_reason = $this->selectedApplication->status_reason;
        $this->mode = 'view';
    }

    public function editApplication($id)
    {
        $this->selectedApplication = ApplicationHead::with(['details', 'reasons', 'media'])->findOrFail($id);
        $this->editDetails = $this->selectedApplication->details ? $this->selectedApplication->details->toArray() : [];
        // Ensure all expected keys exist so empty fields stay empty when updating
        $defaults = [
            'application_head_id' => $this->selectedApplication->id,
            'name' => '',
            'father_name' => '',
            'address' => '',
            'district' => '',
            'pincode' => '',
            'police_station' => '',
            'aadhaar' => '',
            'dob' => '',
            'blood_group' => '',
            'mobile' => '',
            'email' => '',
            'reg_number' => '',
            'reg_date' => '',
            'qualification' => '',
            'examination' => '',
            'held_in' => '',
            'university' => '',
            'college' => '',
            'college_district' => '',
            'final_roll_no' => '',
            'term' => '',
            'university_reg_no' => '',
        ];
        $this->editDetails = array_merge($defaults, $this->editDetails);
        // Ensure date fields are in Y-m-d format for inputs
        if (!empty($this->editDetails['dob'])) {
            $this->editDetails['dob'] = optional($this->selectedApplication->details->dob)->format('Y-m-d');
        }
        if (!empty($this->editDetails['reg_date'])) {
            $this->editDetails['reg_date'] = optional($this->selectedApplication->details->reg_date)->format('Y-m-d');
        }
        $this->mode = 'edit';
    }

    public function backToList()
    {
        $this->mode = 'list';
        $this->reset('selectedApplication', 'newStatus', 'editDetails', 'newMedia');
        $this->resetPage(); // Reset pagination when going back to list
    }

    // Filter methods
    public function applyFilters()
    {
        $this->resetPage(); // Reset pagination when filters are applied
    }

    public function resetFilters()
    {
        $this->reset('fromDate', 'toDate', 'searchNumber', 'searchRegNumber', 'searchAadhaar', 'searchStatus', 'searchReason');
        $this->resetPage();
    }

    // Data update method
    public function updateStatus()
    {
        if (!$this->selectedApplication) {
            session()->flash('error', 'Application not found.');
            return;
        }

        $this->validate(['newStatus' => 'required']);

        $this->selectedApplication->status = $this->newStatus;
        $this->selectedApplication->status_reason = $this->status_reason;
        $this->selectedApplication->save();
        // Attempt to send status update email to applicant if email exists
        try {
            if($this->newStatus === 'approved') {
                $email = $this->selectedApplication->details->email ?? null;
                if ($email) {
                    Mail::to($email)->send(new ApplicationStatusApprovedEmail($this->selectedApplication));
                }
            }else{
                $email = $this->selectedApplication->details->email ?? null;
                if ($email) {
                    Mail::to($email)->send(new ApplicationStatusUpdated($this->selectedApplication));
                }
            }

        } catch (\Exception $e) {
            // Log or ignore mail sending errors; provide user feedback
            Log::error('Failed to send application status update email: ' . $e->getMessage());
            session()->flash('error', 'Status updated, but sending email failed: ' . $e->getMessage());
            return;
        }

        session()->flash('message', 'Application status updated successfully!');
    }

    public function saveEdits()
    {
        if (!$this->selectedApplication) {
            session()->flash('error', 'Application not found.');
            return;
        }

        // Ensure required documents exist before saving edits
        $requiredDocs = ['photo', 'aadhaar', 'paymentProof'];
        $existingDocs = $this->selectedApplication->media->pluck('document_type')->toArray();
        $missing = array_values(array_diff($requiredDocs, $existingDocs));
        if (!empty($missing)) {
            $this->addError('missing_documents', 'Required documents missing: ' . implode(', ', $missing));
            return;
        }

        $rules = [
            'editDetails.name' => 'required|string|max:255',
            'editDetails.mobile' => 'nullable|string|max:50',
            'editDetails.email' => 'nullable|email|max:255',
            'editDetails.aadhaar' => 'nullable|string|max:50',
        ];

        $this->validate($rules);

        // Update or create details
        $details = $this->selectedApplication->details;
        if ($details) {
            $details->update($this->editDetails);
        } else {
            $details = ApplicationDetail::create(array_merge($this->editDetails, ['application_head_id' => $this->selectedApplication->id]));
        }

        // Handle new media uploads
        if (!empty($this->newMedia)) {
            foreach ($this->newMedia as $file) {
                try {
                    $path = $file->store('application_media', 'public');
                    $url = 'storage/' . $path;
                    $docType = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                    ApplicationMedia::create([
                        'application_head_id' => $this->selectedApplication->id,
                        'document_type' => $docType,
                        'original_name' => $file->getClientOriginalName(),
                        'url' => $url,
                    ]);
                } catch (\Exception $e) {
                    // continue on failure for individual files
                    continue;
                }
            }
        }

        session()->flash('message', 'Application updated successfully!');
        $this->mode = 'view';
        // reload selected application
        $this->selectedApplication = ApplicationHead::with(['details', 'reasons', 'media'])->find($this->selectedApplication->id);
        $this->reset('newMedia');
    }

    public function savePersonalInfo()
    {
        if (!$this->selectedApplication) {
            session()->flash('error', 'Application not found.');
            return;
        }

        // Ensure required documents exist before saving personal info
        $requiredDocs = ['photo', 'aadhaar', 'paymentProof'];
        $existingDocs = $this->selectedApplication->media->pluck('document_type')->toArray();
        $missing = array_values(array_diff($requiredDocs, $existingDocs));
        if (!empty($missing)) {
            $this->addError('missing_documents', 'Required documents missing: ' . implode(', ', $missing));
            return;
        }

        $rules = [
            'editDetails.name' => 'required|string|max:255',
            'editDetails.father_name' => 'nullable|string|max:255',
            'editDetails.address' => 'nullable|string|max:1000',
            'editDetails.district' => 'nullable|string|max:255',
            'editDetails.pincode' => 'nullable|string|max:50',
            'editDetails.police_station' => 'nullable|string|max:255',
            'editDetails.aadhaar' => 'required|string|max:50',
            'editDetails.dob' => 'nullable|date',
            'editDetails.blood_group' => 'nullable|string|max:10',
            'editDetails.mobile' => 'required|string|max:50',
            'editDetails.email' => 'required|email|max:255',
            'editDetails.reg_number' => 'required|string|max:255',
            'editDetails.reg_date' => 'nullable|date',
            'editDetails.qualification' => 'nullable|string|max:500',
            'editDetails.examination' => 'nullable|string|max:500',
            'editDetails.held_in' => 'nullable|string|max:255',
            'editDetails.university' => 'nullable|string|max:255',
            'editDetails.college' => 'nullable|string|max:255',
            'editDetails.college_district' => 'nullable|string|max:255',
            'editDetails.final_roll_no' => 'nullable|string|max:255',
            'editDetails.term' => 'nullable|string|max:255',
            'editDetails.university_reg_no' => 'nullable|string|max:255',
            'editDetails.ch_no' => 'nullable|string|max:500',
            'editDetails.provisional_reg_no' => 'nullable|string|max:500',
            'editDetails.registrar_name' => 'nullable|string|max:500',
            'editDetails.other_qulification' => 'nullable',
        ];

        $this->validate($rules);

        $details = $this->selectedApplication->details;
        if ($details) {
            $details->update($this->editDetails);
        } else {
            $details = ApplicationDetail::create(array_merge($this->editDetails, ['application_head_id' => $this->selectedApplication->id]));
        }

        session()->flash('message', 'Personal information updated.');
        $this->selectedApplication = ApplicationHead::with(['details', 'reasons', 'media'])->find($this->selectedApplication->id);
    }

    public function uploadDocument()
    {
        if (!$this->selectedApplication) {
            session()->flash('error', 'Application not found.');
            return;
        }

        $this->validate([
            'uploadDocumentType' => 'required|string',
            'uploadFile' => 'required|file|max:5120',
        ]);

        try {
            $path = $this->uploadFile->store('application_media', 'public');
            $url = 'storage/' . $path;

            ApplicationMedia::create([
                'application_head_id' => $this->selectedApplication->id,
                'document_type' => $this->uploadDocumentType,
                'original_name' => $this->uploadFile->getClientOriginalName(),
                'ext' => $this->uploadFile->getClientOriginalExtension(),
                'url' => $url,
            ]);

            $this->reset('uploadFile', 'uploadDocumentType');
            $this->selectedApplication = ApplicationHead::with(['details', 'reasons', 'media'])->find($this->selectedApplication->id);
            session()->flash('message', 'Document uploaded successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    public function removeMedia($mediaId)
    {
        $media = ApplicationMedia::find($mediaId);
        if (!$media) {
            session()->flash('error', 'Media not found.');
            return;
        }

        // Attempt to delete the underlying file if present
        try {
            $path = preg_replace('#^storage/#', '', $media->url);
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        } catch (\Exception $e) {
            // ignore file delete errors
        }

        $media->delete();
        // refresh selected application media list
        if ($this->selectedApplication) {
            $this->selectedApplication = ApplicationHead::with(['details', 'reasons', 'media'])->find($this->selectedApplication->id);
        }
        session()->flash('message', 'Document removed.');
    }

    public function generateCertificate($id)
    {
        try {
            $application = ApplicationHead::with(['details', 'media'])->findOrFail($id);

            // Generate PDF from the template
            $html = view('web.generate-certificate', ['selectedApplication' => $application])->render();

            $pdf = Pdf::loadHTML($html)
                ->setPaper('a4', 'landscape')
                ->setOption('margin-top', 0)
                ->setOption('margin-bottom', 0)
                ->setOption('margin-left', 0)
                ->setOption('margin-right', 0);

            $fileName = 'Certificate_' . $application->details->name . '_' . now()->format('Y_m_d_His') . '.pdf';

            return response()->streamDownload(
                fn () => print($pdf->output()),
                $fileName
            );
        } catch (\Exception $e) {
            session()->flash('error', 'Error generating certificate: ' . $e->getMessage());
            return;
        }
    }

    public function render()
    {
        $applications = null;
        if ($this->mode === 'list') {
            $query = ApplicationHead::query()->with(['details', 'reasons']);

            // Apply filters
            if ($this->fromDate) {
                $query->whereDate('created_at', '>=', $this->fromDate);
            }
            if ($this->toDate) {
                $query->whereDate('created_at', '<=', $this->toDate);
            }
            if ($this->searchNumber) {
                $query->where('reference_id', 'like', '%' . $this->searchNumber . '%');
            }
            if ($this->searchStatus) {
                $query->where('status', $this->searchStatus);
            }
            if ($this->searchRegNumber) {
                $query->whereHas('details', function ($q) {
                    $q->where('reg_number', 'like', '%' . $this->searchRegNumber . '%');
                });
            }
            if ($this->searchAadhaar) {
                $query->whereHas('details', function ($q) {
                    $q->where('aadhaar', 'like', '%' . $this->searchAadhaar . '%');
                });
            }
            if ($this->searchReason) {
                $query->whereHas('reasons', function ($q) {
                    $q->where('reason_id', $this->searchReason);
                });
            }

            $applications = $query->latest()->paginate(10);
        }

        return view('livewire.application-data-module', [
            'applications' => $applications,
        ]);
    }

    public function export_data_excel()
    {
        $this->excel_downloading = true;
        $filter_data = [
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'searchNumber' => $this->searchNumber,
            'searchRegNumber' => $this->searchRegNumber,
            'searchAadhaar' => $this->searchAadhaar,
            'searchStatus' => $this->searchStatus,
        ];
        $fileName = 'All_Application_Details_' . now()->format('Y_m_d_His') . '.xlsx';
        return Excel::download(new ApplicationDetailsExport($filter_data), $fileName);
    }

    public function showFormDetails($id)
    {
        $app = $this->application;

        $pdf = Pdf::loadView('admin.pdf.application-form', compact('app'))
                ->setPaper('a4', 'portrait');

        $pdfContent = $pdf->output();
        $fileName = 'application-' . $id . '.pdf';
        $filePath = storage_path('app/public/temp/' . $fileName);
        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }

        file_put_contents($filePath, $pdfContent);
        $this->dispatch('open-pdf', url: Storage::url('temp/' . $fileName));
    }
}
