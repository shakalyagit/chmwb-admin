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
        <form action="{{route('update_notice')}}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="hidden" name="notice_id" value="{{ $notice->id }}">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">Notice Type <span class="text-danger">*</span></label>
                    <select class="form-control" name="notice_type">
                        <option value="">Select</option>
                        @foreach($notice_types as $type)
                        <option value="{{$type->id}}" {{ $notice->notice_type_id == $type->id ? 'selected' : '' }}>
                            {{$type->notice_type}}
                        </option>
                        @endforeach
                    </select>
                    @error('notice_type')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Notice Subject <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="notice_subject"
                        value="{{ $notice->notice_subject }}">
                    @error('notice_subject')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Upload Notice <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="document">
                    @if($notice->file_path)
                    <a href="{{ asset($notice->file_path) }}" target="_blank" title="View File"> <i class="bi bi-file-earmark-arrow-down fs-8"></i></a>
                    @endif
                    @error('document')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Publish Date & Time <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" name="datetime"
                        value="{{ \Carbon\Carbon::parse($notice->publish_date_time)->format('Y-m-d\TH:i') }}">
                    @error('datetime')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12 mt-3">
                    <label class="form-label">Notice Body <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="notice_body" name="notice_body">{{ $notice->notice_body }}</textarea>
                    @error('notice_body')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-3 mt-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-control" name="status">
                        <option value="Publish" {{ $notice->status == 'Publish' ? 'selected' : '' }}>Publish</option>
                        <option value="Unpublish" {{ $notice->status == 'Unpublish' ? 'selected' : '' }}>Unpublish</option>
                    </select>
                    @error('status')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
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