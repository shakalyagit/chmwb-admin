@extends('admin.layouts.main')
@section('content')
<div class="content-header">
    <h5 class="pull-left">Add practitioner</h5>
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
        <form action="{{route('add_practitioner_action')}}" method="post" id="add_practitioner_form">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Registration No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('registration_no')}}" name="registration_no" id="registration_no">
                    </div>
                    @error('registration_no')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Registration Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" value="{{old('registration_date')}}" name="registration_date" id="registration_date">
                    </div>
                    @error('registration_date')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name">
                    </div>
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" value="{{old('email_id')}}" name="email_id" id="email_id">
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
                        <input type="text" class="form-control" value="{{old('fathers_name')}}" name="fathers_name" id="fathers_name">
                    </div>
                    @error('fathers_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" value="{{old('ph_no')}}" name="ph_no" id="ph_no">
                    </div>
                    @error('ph_no')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Qualification <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('qualification')}}" name="qualification" id="qualification">
                    </div>
                    @error('qualification')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Part <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('part')}}" name="part" id="part">
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
                        <textarea class="form-control" style="height: 100px;" name="address" id="address">{{old('address')}}</textarea>
                    </div>
                    @error('address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">State <span class="text-danger">*</span></label>
                        <select name="state" id="state" class="form-select">
                            <option value="">Select State</option>
                            @foreach($states as $state)
                            <option value="{{ $state->sid }}"
                                {{ old('state') == $state->sid ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error('state')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">District <span class="text-danger">*</span></label>
                        <select name="district" id="district" class="form-select">
                            <option value="">Select District</option>
                        </select>
                    </div>
                    @error('district')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Pincode <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('pincode')}}" name="pincode" id="pincode">
                    </div>
                    @error('pincode')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-end mt-3">
                    <a href="{{route('practitioners_list')}}" class="btn btn-outline-secondary" style="margin-right: 15px;" type="submit">Cancel</a>
                    <button class="btn btn-primary" id="add_risk" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.getElementById('state').addEventListener('change', function() {
        let stateSid = this.value;
        let districtSelect = document.getElementById('district');

        districtSelect.innerHTML = '<option value="">Loading...</option>';

        if (!stateSid) {
            districtSelect.innerHTML = '<option value="">Select District</option>';
            return;
        }

        fetch(`/get-districts/${stateSid}`)
            .then(response => response.json())
            .then(data => {
                districtSelect.innerHTML = '<option value="">Select District</option>';

                data.forEach(district => {
                    let option = document.createElement('option');
                    option.value = district.name;
                    option.textContent = district.name;
                    districtSelect.appendChild(option);
                });
            })
            .catch(() => {
                districtSelect.innerHTML = '<option value="">Error loading districts</option>';
            });
    });
</script>
@endsection