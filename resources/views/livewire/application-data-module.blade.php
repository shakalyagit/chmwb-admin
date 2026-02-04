<div>
    {{-- Flash message display --}}
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($mode === 'list')
        <div class="card mt-3">
            <div class="card-header bg-100">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Application List</h5>
                    {{-- <button class="btn btn-outline-warning" wire:click='export_data_excel'> <i
                            class="bi bi-cloud-download"></i>
                        Export</button> --}}
                    @if (Auth::user()->id != 2)
                        <button wire:click="export_data_excel" wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed" wire:target="export_data_excel"
                            class="btn btn-outline-warning">
                            <i class="bi bi-cloud-download"></i>
                            <span wire:loading.remove wire:target="export_data_excel">Export to Excel</span>
                            <span wire:loading wire:target="export_data_excel">
                                <span class="spinner-border spinner-border-sm me-1" role="status"
                                    aria-hidden="true"></span>
                                Downloading...
                            </span>
                        </button>
                    @endif

                </div>
            </div>
            <div class="card-header">
                <!-- Filters -->
                <div class="row g-3 align-items-center">
                    <div class="col-md-2">
                        <input type="date" class="form-control" wire:model.defer="fromDate" title="From Date">
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" wire:model.defer="toDate" title="To Date">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" wire:model.defer="searchNumber"
                            placeholder="Application No.">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" wire:model.defer="searchRegNumber"
                            placeholder="Reg. No.">
                    </div>
                    <div class="col-md-2">
                        <select wire:model.defer="searchReason" class="form-select">
                            <option value="">All Reasons</option>
                            <option value="change-surname">Change of Surname</option>
                            <option value="change-address">Change of Address</option>
                            <option value="duplicate-cert">Duplicate Certificate</option>
                            <option value="retention-reg">Retention of Registration</option>
                            <option value="additional-qual">Additional Qualification</option>
                            <option value="cancel-reg">Cancellation of Registration</option>
                            <option value="doctor-id">Doctor's ID Card</option>
                            <option value="provisional-reg">Provisional Registration</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select wire:model.defer="searchStatus" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="submitted">Submitted</option>
                            <option value="verifying">Verifying</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-12 text-end mt-3">
                        <button wire:click="applyFilters" class="btn btn-outline-primary"> <i class="bi bi-funnel"></i>
                            Filter</button>
                        <button type="button" wire:click="resetFilters" class="btn btn-outline-warning"><i
                                class="bi bi-arrow-clockwise"></i> Reset</button>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--1 mb-0">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="text-nowrap">Name</th>
                                @if (Auth::user()->id != 2)
                                    <th class="text-nowrap">Mo. Number</th>
                                @endif
                                <th class="text-nowrap">Application No.</th>
                                @if (Auth::user()->id != 2)
                                    <th class="text-nowrap">Aadhaar No.</th>
                                @endif
                                <th class="text-wrap">Reasons</th>
                                <th>Status</th>
                                <th class="text-end text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($applications as $app)
                                <tr>
                                    <td>{{ $app->details->name ?? 'N/A' }}</td>
                                    @if (Auth::user()->id != 2)
                                    <td>{{ $app->details->mobile ?? 'N/A' }}</td>
                                    @endif
                                    <td>{{ $app->details->reg_number ?? 'N/A' }}</td>
                                    @if (Auth::user()->id != 2)
                                    <td>{{ $app->details->aadhaar ?? 'N/A' }}</td>
                                    @endif
                                    <td class="text-wrap">
                                        @foreach ($app->reasons as $reason)
                                            <span
                                                class="badge rounded-pill bg-danger-subtle text-danger border border-danger ">{{ $this->getReasonLabel($reason->reason_id) }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($app->status == 'submitted')
                                            <span
                                                class="badge rounded-pill bg-warning-subtle border text-dark text-warning border-warning">{{ ucfirst($app->status) }}</span>
                                        @elseif($app->status == 'verifying')
                                            <span
                                                class="badge rounded-pill bg-info-subtle border border-info text-primary">{{ ucfirst($app->status) }}</span>
                                        @elseif($app->status == 'approved')
                                            <span
                                                class="badge rounded-pill bg-success-subtle border border-success text-success">{{ ucfirst($app->status) }}</span>
                                        @elseif($app->status == 'rejected')
                                            <span
                                                class="badge rounded-pill bg-danger-subtle border border-danger text-danger">{{ ucfirst($app->status) }}</span>
                                        @else
                                            <span
                                                class="badge rounded-pill bg-secondary-subtle border border-secondary text-white">{{ ucfirst($app->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-end text-nowrap no-wrap">
                                        <a class="btn btn-sm btn-outline-warning" target="_blank"
                                            href="/showFormDetails/{{ $app->id }}">
                                            <i class="bi bi-eye-fill"></i> Form Details
                                        </a>
                                        <button class="btn btn-sm btn-outline-primary"
                                            wire:click="viewApplication({{ $app->id }})">
                                            <i class="bi bi-eye-fill"></i> View
                                        </button>
                                        <button class="btn btn-sm btn-outline-success ms-1"
                                            wire:click="editApplication({{ $app->id }})">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">No applications found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $applications->links() }}
            </div>
        </div>
    @elseif ($mode === 'edit' && $selectedApplication)
        <div class="card mt-3">
            <div class="card-header bg-100 d-flex justify-content-between align-items-center">
                <h5>Edit Application: #{{ $selectedApplication->reference_id }}
                    <span class="ms-3">
                        @foreach ($selectedApplication->reasons as $reason)
                            <span
                                class="badge rounded-pill bg-danger-subtle text-danger border border-danger ">{{ $this->getReasonLabel($reason->reason_id) }}</span>
                        @endforeach
                    </span>
                </h5>
                <div>
                    <button wire:click="backToList" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-lg-8">
                        <div class="card mb-4 shadow-none border">
                            <div class="card-header">
                                <h6>Personal Information & Academic</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.name">
                                        @error('editDetails.name')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Father's Name</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.father_name">
                                        @error('editDetails.father_name')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.address">
                                        @error('editDetails.address')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">District</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.district">
                                        @error('editDetails.district')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pincode</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.pincode">
                                        @error('editDetails.pincode')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Police Station</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.police_station">
                                        @error('editDetails.police_station')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Aadhaar</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.aadhaar">
                                        @error('editDetails.aadhaar')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">DoB</label>
                                        <input type="date" class="form-control"
                                            wire:model.defer="editDetails.dob">
                                        @error('editDetails.dob')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Blood Group</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.blood_group">
                                        @error('editDetails.blood_group')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Mobile</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.mobile">
                                        @error('editDetails.mobile')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control"
                                            wire:model.defer="editDetails.email">
                                        @error('editDetails.email')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Reg. Number</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.reg_number">
                                        @error('editDetails.reg_number')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Reg. Date</label>
                                        <input type="date" class="form-control"
                                            wire:model.defer="editDetails.reg_date">
                                        @error('editDetails.reg_date')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Qualification</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.qualification">
                                        @error('editDetails.qualification')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Examination</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.examination">
                                        @error('editDetails.examination')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">University</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.university">
                                        @error('editDetails.university')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">College</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.college">
                                        @error('editDetails.college')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">College District</label>
                                        <select id="collegeDistrict" wire:model="editDetails.college_district"
                                            class="form-control dropdown-indicator">
                                            <option value="">Select District</option>
                                            <option value="Asansol, Paschim Bardhaman">Asansol, Paschim Bardhaman
                                            </option>
                                            <option value="Kolkata">Kolkata</option>
                                            <option value="Howrah">Howrah</option>
                                            <option value="Paschim Medinipur">Paschim Medinipur</option>
                                            <option value="Birbhum">Birbhum</option>
                                            <option value="Purba Bardhaman">Purba Bardhaman</option>
                                        </select>
                                        @error('editDetails.college_district')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Held In</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.held_in">
                                        @error('editDetails.held_in')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Final Roll No.</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.final_roll_no">
                                        @error('editDetails.final_roll_no')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Term</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.term">
                                        @error('editDetails.term')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Paragraph of the schedule under which
                                            registration</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.pragraph_of_schedule">
                                        @error('editDetails.pragraph_of_schedule')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Registrar Name</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.registrar_name">
                                        @error('editDetails.registrar_name')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Other Qualifications</label>
                                        <textarea class="form-control" wire:model.defer="editDetails.other_qulification"
                                            name="editDetails.other_qulification" id="" rows="5"></textarea>
                                        @error('editDetails.other_qulification')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">University Reg. No.</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer="editDetails.university_reg_no">
                                        @error('editDetails.university_reg_no')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- Hidden application head id --}}
                                    <input type="hidden" wire:model.defer="editDetails.application_head_id">

                                    <hr>
                                    @if ($selectedApplication->reasons[0]->reason_id === 'provisional-reg')
                                        <div class="col-md-6">
                                            <label class="form-label">CH No.</label>
                                            <input type="text" class="form-control"
                                                wire:model.defer="editDetails.ch_no">
                                            @error('editDetails.ch_no')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Provisional Reg. No.</label>
                                            <input type="text" class="form-control"
                                                wire:model.defer="editDetails.provisional_reg_no">
                                            @error('editDetails.provisional_reg_no')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <div class="d-flex justify-content-end">
                                    <button type="button" wire:click="savePersonalInfo" wire:loading.attr="disabled"
                                        class="btn btn-success">
                                        <i class="bi bi-check2-circle"></i> Update Information
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card mb-4 shadow-none border">
                            <div class="card-header">
                                <h6>Uploaded Documents</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush mb-3">
                                    @forelse ($selectedApplication->media as $media)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                {{ Str::title(str_replace('_', ' ', $media->document_type)) }}
                                            </div>
                                            <div class="btn-group">
                                                <a href="{{ asset($media->url) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-warning me-1">
                                                    <i class="bi bi-file-earmark-arrow-down"></i>
                                                </a>
                                                <button type="button"
                                                    wire:click.prevent="removeMedia({{ $media->id }})"
                                                    class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="list-group-item text-muted">No documents uploaded.</li>
                                    @endforelse
                                </ul>

                                <div class="mb-2 mt-3">
                                    <label class="form-label">Select Document Name</label>
                                    <select class="form-select" wire:model="uploadDocumentType">
                                        <option value="">Select document name</option>
                                        @foreach ($documentTypes as $dt)
                                            <option value="{{ $dt }}">
                                                {{ Str::title(str_replace('_', ' ', $dt)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('uploadDocumentType')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                @error('missing_documents')
                                    <div class="alert alert-danger small py-1 error text-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-4 mt-3">
                                    <label class="form-label">Upload / Re-upload Document</label>
                                    <input type="file" wire:model="uploadFile" class="form-control">
                                    @error('uploadFile')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-2 mt-3">
                                    <div class="small text-muted error">Required documents: <strong>photo</strong>,
                                        <strong>aadhaar</strong>, <strong>paymentProof</strong>
                                    </div>
                                </div>
                                <div class="d-grid mt-3">
                                    <button type="button" wire:click="uploadDocument" wire:loading.attr="disabled"
                                        class="btn btn-primary">
                                        <i class="bi bi-upload"></i> Upload Document
                                    </button>
                                </div>
                                <div wire:loading wire:target="uploadFile" class="mt-2">
                                    <div class="spinner-border spinner-border-sm me-1" role="status"
                                        aria-hidden="true"></div>
                                    Uploading...
                                </div>
                            </div>
                        </div>


                    </div>

                </form>
            </div>
        </div>
    @elseif ($mode === 'view' && $selectedApplication)
        <div class="card mt-3">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Application Details: #{{ $selectedApplication->reference_id }}
                        <span class="ms-3">
                            @foreach ($selectedApplication->reasons as $reason)
                                <span
                                    class="badge rounded-pill bg-danger-subtle text-danger border border-danger ">{{ $this->getReasonLabel($reason->reason_id) }}</span>
                            @endforeach
                        </span>
                    </h5>

                    @if ($selectedApplication->reasons->where('reason_id', 'provisional-reg')->count() > 0)
                        <a href="{{ route('generate_certificate', $selectedApplication->id) }}" target="_blank"
                            class="btn btn-outline-primary float-end me-2">
                            <i class="bi bi-patch-check"></i> Download Certificate
                        </a>
                    @else
                        <a href="{{ route('generate_certificate_2', $selectedApplication->id) }}" target="_blank"
                            class="btn btn-outline-primary float-end me-2">
                            <i class="bi bi-patch-check"></i> Download Certificate
                        </a>
                    @endif

                    <div>
                        <button class="btn btn-sm btn-outline-success ms-1"
                            wire:click="editApplication({{ $selectedApplication->id }})">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </button>

                        <button wire:click="backToList" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </button>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    {{-- Left Column: Information --}}
                    <div class="col-lg-8">
                        {{-- Personal Information --}}
                        <div class="card mb-4 shadow-none border">
                            <div class="card-header">
                                <h6>Personal Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-2"><strong>Name:</strong>
                                        {{ $selectedApplication->details->name }}</div>
                                    <div class="col-md-6 mb-2"><strong>Father's Name:</strong>
                                        {{ $selectedApplication->details->father_name }}</div>
                                    <div class="col-md-12 mb-2"><strong>Address:</strong>
                                        {{ $selectedApplication->details->address }},
                                        {{ $selectedApplication->details->district }} -
                                        {{ $selectedApplication->details->pincode }}</div>
                                    <div class="col-md-6 mb-2"><strong>Police Station:</strong>
                                        {{ $selectedApplication->details->police_station }}</div>
                                    <div class="col-md-6 mb-2"><strong>Aadhaar:</strong>
                                        {{ $selectedApplication->details->aadhaar }}</div>
                                    @if ($selectedApplication->details->dob)
                                        <div class="col-md-6 mb-2"><strong>DoB:</strong>
                                            {{ $selectedApplication->details->dob->format('d/m/Y') }}</div>
                                    @endif
                                    <div class="col-md-6 mb-2"><strong>Blood Group:</strong>
                                        {{ $selectedApplication->details->blood_group ?: 'N/A' }}</div>
                                    <div class="col-md-6 mb-2"><strong>Mobile:</strong>
                                        {{ $selectedApplication->details->mobile }}</div>
                                    <div class="col-md-6 mb-2"><strong>Email:</strong>
                                        {{ $selectedApplication->details->email }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Academic Information --}}
                        <div class="card shadow-none border">
                            <div class="card-header">
                                <h6>Academic & Registration Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-2"><strong>Reg. Number:</strong>
                                        {{ $selectedApplication->details->reg_number ?: 'N/A' }}</div>
                                    @if ($selectedApplication->details->reg_date)
                                        <div class="col-md-6 mb-2"><strong>Reg. Date:</strong>
                                            {{ $selectedApplication->details->reg_date->format('d/m/Y') }}</div>
                                    @endif

                                    <div class="col-md-6 mb-2"><strong>Qualification:</strong>
                                        {{ $selectedApplication->details->qualification ?: 'N/A' }}</div>
                                    <div class="col-md-6 mb-2"><strong>Held In:</strong>
                                        {{ $selectedApplication->details->held_in ?: 'N/A' }}</div>
                                    <div class="col-md-6 mb-2"><strong>Examination:</strong>
                                        {{ $selectedApplication->details->examination ?: 'N/A' }}</div>
                                    <div class="col-md-6 mb-2"><strong>University:</strong>
                                        {{ $selectedApplication->details->university }}</div>
                                    <div class="col-md-6 mb-2"><strong>College:</strong>
                                        {{ $selectedApplication->details->college }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Documents & Status --}}
                    <div class="col-lg-4">
                        {{-- Uploaded Documents --}}
                        <div class="card mb-4 shadow-none border">
                            <div class="card-header">
                                <h6>Uploaded Documents</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    @forelse ($selectedApplication->media as $media)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ Str::title(str_replace('_', ' ', $media->document_type)) }}
                                            <a href="{{ asset($media->url) }}" target="_blank"
                                                class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-file-earmark-arrow-down"></i> View
                                            </a>
                                            {{-- <a href="{{ config('app.asset_url') . $media->url }}" target="_blank"
                                                class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-file-earmark-arrow-down"></i> View
                                            </a> --}}
                                        </li>
                                    @empty
                                        <li class="list-group-item text-muted">No documents uploaded.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        {{-- Status Update --}}
                        <div class="card shadow-none border">
                            <div class="card-header">
                                <h6>Update Status</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Application Status</label>
                                    <select wire:model="newStatus" id="status" class="form-select">
                                        <option value="submitted">Submitted</option>
                                        <option value="verifying">Verifying</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status_reason" class="form-label">Application Status Reason</label>
                                    <textarea wire:model.defer="status_reason" id="status_reason" class="form-control" rows="3"></textarea>
                                </div>
                                <button wire:click="updateStatus" class="btn btn-primary w-100">
                                    <i class="bi bi-check-circle"></i> Update Status
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
