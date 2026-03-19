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
<div class="card">
    <div class="card-body">
        <form action="{{route('add_notice_action')}}" enctype="multipart/form-data" method="post" id="add_notice_form">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Notice Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="notice_type" id="notice_type">
                            <option value="">Select</option>
                            @foreach($notice_types as $notice_type)
                            <option value="{{$notice_type->id}}">{{$notice_type->notice_type}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('notice_type')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Notice Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('notice_subject')}}" name="notice_subject" id="notice_subject">
                    </div>
                    @error('notice_subject')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Upload Notice <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="document" id="document">
                    @error('document')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <div class="form-group">
                        <label class="form-label">Publish Date & Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" value="{{old('datetime')}}" name="datetime" id="datetime">
                    </div>
                    @error('datetime')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label">Notice Body <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="notice_body" id="notice_body">{{old('notice_body')}}</textarea>
                    </div>
                    @error('notice_body')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Select</option>
                            <option value="Publish">Publish</option>
                            <option value="Unpublish">Unpublish</option>
                        </select>
                    </div>
                    @error('status')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-end mt-3">
                    <a href="{{route('notice_list')}}" class="btn btn-outline-secondary" style="margin-right: 15px;" type="submit">Cancel</a>
                    <button class="btn btn-primary" id="add_notice" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
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