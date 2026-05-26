@extends('admin.layouts.main')
@section('content')
<div class="content-header">
    <h5 class="pull-left">Add pharmacist</h5>
    <div class="ms-auto pull-right">
        <a href="{{route('pharmacist_list')}}" class="btn btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="clear"></div>
</div>
<x-flash-message />
<div class="card">
    <div class="card-body">
        <form action="{{route('add_pharmacist_action')}}" method="post" id="add_pharmacist_form">
            @csrf

            {{-- Personal Information --}}
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name">
                    </div>
                    @error('name')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Father's Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('father_name')}}" name="father_name" id="father_name">
                    </div>
                    @error('father_name')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Aadhaar Number</label>
                        <input type="text" class="form-control" value="{{old('aadhaar_number')}}" name="aadhaar_number" id="aadhaar_number">
                    </div>
                    @error('aadhaar_number')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" value="{{old('date_of_birth')}}" name="date_of_birth" id="date_of_birth">
                    </div>
                    @error('date_of_birth')<span class="text-danger">{{$message}}</span>@enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    @error('gender')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" value="{{old('mobile_number')}}" name="mobile_number" id="mobile_number">
                    </div>
                    @error('mobile_number')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{old('email_id')}}" name="email_id" id="email_id">
                    </div>
                    @error('email_id')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Registration Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('registration_number')}}" name="registration_number" id="registration_number">
                    </div>
                    @error('registration_number')<span class="text-danger">{{$message}}</span>@enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Registration Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" value="{{old('registration_date')}}" name="registration_date" id="registration_date">
                    </div>
                    @error('registration_date')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Valid Upto</label>
                        <input type="date" class="form-control" value="{{old('valid_upto')}}" name="valid_upto" id="valid_upto">
                    </div>
                    @error('valid_upto')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Qualification Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('qualification_name')}}" name="qualification_name" id="qualification_name">
                    </div>
                    @error('qualification_name')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Month/Year of Degree</label>
                        <input type="text" class="form-control" value="{{old('month_year_of_degree')}}" name="month_year_of_degree" id="month_year_of_degree">
                    </div>
                    @error('month_year_of_degree')<span class="text-danger">{{$message}}</span>@enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">College Name</label>
                        <input type="text" class="form-control" value="{{old('college_name')}}" name="college_name" id="college_name">
                    </div>
                    @error('college_name')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Addl. Qualification</label>
                        <input type="text" class="form-control" value="{{old('additional_qualification_name')}}" name="additional_qualification_name" id="additional_qualification_name">
                    </div>
                    @error('additional_qualification_name')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Addl. Month/Year of Degree</label>
                        <input type="text" class="form-control" value="{{old('additional_month_year_of_degree')}}" name="additional_month_year_of_degree" id="additional_month_year_of_degree">
                    </div>
                    @error('additional_month_year_of_degree')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Addl. College Name</label>
                        <input type="text" class="form-control" value="{{old('additional_college_name')}}" name="additional_college_name" id="additional_college_name">
                    </div>
                    @error('additional_college_name')<span class="text-danger">{{$message}}</span>@enderror
                </div>
            </div>

            {{-- ===================== ADDRESS CARD ===================== --}}
            <div class="card border mt-2 mb-3">
                <div class="card-header bg-light py-2">
                    <h6 class="mb-0 fw-semibold">Address Details</h6>
                </div>
                <div class="card-body">

                    {{-- Present Address --}}
                    <h6 class="text-muted mb-3" style="font-size: 13px; text-transform: uppercase; letter-spacing: .05em;">
                        Present Address
                    </h6>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Address Line <span class="text-danger">*</span></label>
                                <textarea class="form-control" style="height: 80px;" name="present_address_line" id="present_address_line">{{old('present_address_line')}}</textarea>
                            </div>
                            @error('present_address_line')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">State</label>
                                <select name="present_state" id="present_state" class="form-select">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                    <option value="{{ $state->sid }}" {{ old('present_state') == $state->sid ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('present_state')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">District</label>
                                <select name="present_district" id="present_district" class="form-select">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                            @error('present_district')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Pincode</label>
                                <input type="text" class="form-control" value="{{old('present_pincode')}}" name="present_pincode" id="present_pincode">
                            </div>
                            @error('present_pincode')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Police Station</label>
                                <input type="text" class="form-control" value="{{old('present_police_station')}}" name="present_police_station" id="present_police_station">
                            </div>
                            @error('present_police_station')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                    <hr class="my-3">

                    {{-- Permanent Address --}}
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="text-muted mb-0" style="font-size: 13px; text-transform: uppercase; letter-spacing: .05em;">
                            Permanent Address
                        </h6>
                        {{-- Optional: "Same as Present Address" checkbox --}}
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" id="same_as_present">
                            <label class="form-check-label" for="same_as_present" style="font-size: 13px;">
                                Same as present address
                            </label>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Address Line <span class="text-danger">*</span></label>
                                <textarea class="form-control" style="height: 80px;" name="permanent_address_line" id="permanent_address_line">{{old('permanent_address_line')}}</textarea>
                            </div>
                            @error('permanent_address_line')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">State</label>
                                <select name="permanent_state" id="permanent_state" class="form-select">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                    <option value="{{ $state->sid }}" {{ old('permanent_state') == $state->sid ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('permanent_state')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">District</label>
                                <select name="permanent_district" id="permanent_district" class="form-select">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                            @error('permanent_district')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Pincode</label>
                                <input type="text" class="form-control" value="{{old('permanent_pincode')}}" name="permanent_pincode" id="permanent_pincode">
                            </div>
                            @error('permanent_pincode')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Police Station</label>
                                <input type="text" class="form-control" value="{{old('permanent_police_station')}}" name="permanent_police_station" id="permanent_police_station">
                            </div>
                            @error('permanent_police_station')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                </div>
            </div>
            {{-- =================== END ADDRESS CARD =================== --}}

            {{-- ===================== ADDITIONAL FIELDS CARD ===================== --}}
            <div class="card border mt-2 mb-3">
                <div class="card-header bg-light py-2">
                    <h6 class="mb-0 fw-semibold">Additional Fields</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Field 1</label>
                                <input type="text" class="form-control" value="{{old('field_1')}}" name="field_1" id="field_1">
                            </div>
                            @error('field_1')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Field 2</label>
                                <input type="text" class="form-control" value="{{old('field_2')}}" name="field_2" id="field_2">
                            </div>
                            @error('field_2')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Field 3</label>
                                <input type="text" class="form-control" value="{{old('field_3')}}" name="field_3" id="field_3">
                            </div>
                            @error('field_3')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Field 4</label>
                                <input type="text" class="form-control" value="{{old('field_4')}}" name="field_4" id="field_4">
                            </div>
                            @error('field_4')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
            {{-- =================== END ADDITIONAL FIELDS CARD =================== --}}

            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-end mt-3">
                    <a href="{{route('pharmacist_list')}}" class="btn btn-outline-secondary" style="margin-right: 15px;">Cancel</a>
                    <button class="btn btn-primary" id="add_risk" type="submit">Save</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function loadDistricts(stateId, districtSelectId) {
        const districtSelect = document.getElementById(districtSelectId);
        districtSelect.innerHTML = '<option value="">Loading...</option>';

        if (!stateId) {
            districtSelect.innerHTML = '<option value="">Select District</option>';
            return Promise.resolve();
        }

        return fetch(`/get-districts/${stateId}`)
            .then(response => response.json())
            .then(data => {
                districtSelect.innerHTML = '<option value="">Select District</option>';
                data.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.name;
                    option.textContent = district.name;
                    districtSelect.appendChild(option);
                });
            })
            .catch(() => {
                districtSelect.innerHTML = '<option value="">Error loading districts</option>';
            });
    }

    document.getElementById('present_state').addEventListener('change', function() {
        loadDistricts(this.value, 'present_district');
    });

    document.getElementById('permanent_state').addEventListener('change', function() {
        loadDistricts(this.value, 'permanent_district');
    });
</script>
<script>
    document.getElementById('same_as_present').addEventListener('change', function() {
        const copy = this.checked;

        // Copy basic fields
        document.getElementById('permanent_address_line').value = copy ? document.getElementById('present_address_line').value : '';
        document.getElementById('permanent_pincode').value = copy ? document.getElementById('present_pincode').value : '';
        document.getElementById('permanent_police_station').value = copy ? document.getElementById('present_police_station').value : '';

        const presState = document.getElementById('present_state');
        const presDistrict = document.getElementById('present_district');
        const permState = document.getElementById('permanent_state');
        const permDistrict = document.getElementById('permanent_district');

        if (copy && presState.value) {
            permState.value = presState.value;

            loadDistricts(presState.value, 'permanent_district').then(() => {
                permDistrict.value = presDistrict.value;
            });
        } else {
            permState.value = '';
            permDistrict.innerHTML = '<option value="">Select District</option>';
        }
    });
</script>
@endsection