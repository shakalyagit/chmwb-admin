@extends('admin.layouts.main')
@section('content')
<div class="content-header">
    <h5 class="pull-left">Add notice</h5>
    <div class="ms-auto pull-right">
        <a href="{{route('notice_list')}}" class="btn btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="clear"></div>
</div>
<x-flash-message />
<form action="{{route('add_notice_action')}}" method="post" id="add_risk_form" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Notice Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="notice_type" id="notice_type">
                                    <option value="">Select</option>
                                    @foreach($notice_types as $notice_type)
                                    <option value="{{$notice_type->id}}" {{ old('notice_type') == $notice_type->id ? 'selected' : '' }}>{{$notice_type->notice_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('notice_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-8 mb-3">
                            <div class="form-group">
                                <label class="form-label">Notice Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('notice_subject')}}" name="notice_subject" id="notice_subject">
                            </div>
                            @error('notice_subject')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Notice Body</label>
                                <textarea class="form-control" name="notice_body" id="notice_body">{{old('notice_body')}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Publish Date & Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" value="{{old('datetime')}}" name="datetime" id="datetime">
                            </div>
                            @error('datetime')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">Select</option>
                                    <option value="Publish" {{ old('status') == 'Publish' ? 'selected' : '' }}>Publish</option>
                                    <option value="Unpublish" {{ old('status') == 'Unpublish' ? 'selected' : '' }}>Unpublish</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <label>Upload Notice</label>
                    <div class="upload-area" id="upload-area">
                        <input type="file" id="files" multiple=""
                            class="custom-file-input form-control" accept=".jpg,.jpeg,.png,.pdf"
                            name="document[]">
                    </div>
                    <div class="file-preview row" id="file-preview"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-end mt-3">
            <a href="{{route('notice_list')}}" class="btn btn-outline-secondary" style="margin-right: 15px;" type="submit">Cancel</a>
            <button class="btn btn-primary" id="add_notice" type="submit">Save</button>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script>
    tinymce.init({
        selector: '#notice_body',
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | bold italic underline | bullist numlist | link image | alignleft aligncenter alignright alignjustify | table | code',
        menubar: false,
        branding: false,
        height: 200
    });
</script>
@endsection