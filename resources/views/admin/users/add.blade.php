@extends('layouts.main')
@section('content')
<style>
    textarea.form-control {
        height: auto !important;
    }
</style>
<div class="content-header">
    <h5 class="pull-left">Add new user</h5>
    <div class="ms-auto pull-right">
        <x-back-btn :url="route('users')" btn_class="btn-outline-primary" icon="bi-arrow-left" title="Back" />
    </div>
    <div class="clear"></div>
</div>
<x-flash />
<div class="card">
    <div class="card-body">
        <form action="{{route('add_user_action')}}" method="post" id="add_user_form">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Division <span class="text-danger">*</span></label>
                        <select name="division_id" id="division_id" class="form-select">
                            <option value="">Select</option>
                            @if(count($divisions)>0)
                            @foreach($divisions as $division)
                            <option value="{{$division->division_id}}">{{$division->division_name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Role <span class="text-danger">*</span></label>
                        <select name="role_id" id="role_id" class="form-select">
                            <option value="">Select</option>
                            @if(count($roles)>0)
                            @foreach($roles as $role)
                            <option value="{{$role->role_id}}">{{$role->role_name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-end mt-3">
                    <a href="{{route('users')}}" class="btn btn-outline-secondary" style="margin-right: 15px;" type="submit">Cancel</a>
                    <button class="btn btn-primary" id="add_risk" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')

@endsection