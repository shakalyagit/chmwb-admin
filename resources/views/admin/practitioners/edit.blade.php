@extends('admin.layouts.main')
@section('content')
<div class="content-header">
    <h5 class="pull-left">Edit practitioner</h5>
    <div class="ms-auto pull-right">
        <a href="{{route('practitioners_list')}}" class="btn btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="clear"></div>
</div>
<x-flash-message />
<div class="card">
    <div class="card-body">
        <form action="{{route('update_practitioner',Crypt::encrypt($practitioner->id))}}" method="post" id="add_user_form">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Registration No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{$practitioner->registration_no}}" name="registration_no" id="registration_no" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Registration Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" value="{{$practitioner->registration_date}}" name="registration_date" id="registration_date">
                    </div>
                    @error('registration_date')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{$practitioner->name}}" name="name" id="name">
                    </div>
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{$practitioner->email_id}}" name="email_id" id="email_id">
                    </div>
                    @error('email_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Fathers Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{$practitioner->fathers_name}}" name="fathers_name" id="fathers_name">
                    </div>
                    @error('fathers_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="number" class="form-control" value="{{$practitioner->ph_no}}" name="ph_no" id="ph_no">
                    </div>
                    @error('ph_no')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Qualification <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{$practitioner->qualification}}" name="qualification" id="qualification">
                    </div>
                    @error('qualification')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Part</label>
                        <input type="text" class="form-control" value="{{$practitioner->part}}" name="part" id="part">
                    </div>
                    @error('part')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Address <span class="text-danger">*</span></label>
                        <textarea class="form-control" style="height: 100px;" name="address" id="address">{{$practitioner->address}}</textarea>
                    </div>
                    @error('address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">State</label>
                        <!-- <select name="state" id="state" class="form-select">
                            <option value="">Select State</option>
                            @foreach($states as $state)
                            <option value="{{ $state->sid }}"
                                {{ $practitioner->state == $state->sid ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                            @endforeach
                        </select> -->
                        <input type="text" class="form-control" value="{{$practitioner->state}}" name="state" id="state">
                    </div>
                    @error('state')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">District</label>
                        <!-- <select name="district" id="district" class="form-select">
                            <option value="">Select District</option>
                        </select> -->
                        <input type="text" class="form-control" value="{{$practitioner->district}}" name="district" id="district">
                    </div>
                    @error('district')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Pincode</label>
                        <input type="text" class="form-control" value="{{$practitioner->pincode}}" name="pincode" id="pincode">
                    </div>
                    @error('pincode')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">Select</option>
                            <option value="Active" {{ $practitioner->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $practitioner->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    @error('status')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-end mt-3">
                    <a href="{{route('practitioners_list')}}" class="btn btn-outline-secondary" style="margin-right: 15px;" type="submit">Cancel</a>
                    <button class="btn btn-primary" id="add_risk" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const stateSelect = document.getElementById('state');
        const districtSelect = document.getElementById('district');

        const selectedState = "{{ $practitioner->state }}";
        const selectedDistrict = "{{ $practitioner->district }}";

        function loadDistricts(stateSid, selected = null) {
            if (!stateSid) return;

            fetch(`/get-districts/${stateSid}`)
                .then(response => response.json())
                .then(data => {
                    districtSelect.innerHTML = '<option value="">Select District</option>';

                    data.forEach(district => {
                        let option = document.createElement('option');
                        option.value = district.name;
                        option.textContent = district.name;

                        if (selected && district.name === selected) {
                            option.selected = true;
                        }

                        districtSelect.appendChild(option);
                    });
                });
        }

        // Load districts on page load (EDIT MODE)
        if (selectedState) {
            loadDistricts(selectedState, selectedDistrict);
        }

        // Load districts on state change
        stateSelect.addEventListener('change', function() {
            loadDistricts(this.value);
        });
    });
</script>
@endsection