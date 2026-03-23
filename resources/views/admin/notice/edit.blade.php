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
<div id="flash-message"></div>
<form action="{{route('update_notice')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="notice_id" value="{{ $notice->id }}">
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
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
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Notice Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="notice_subject"
                                value="{{ $notice->notice_subject }}">
                            @error('notice_subject')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Notice Body</label>
                            <textarea class="form-control" id="notice_body" name="notice_body">{{ $notice->notice_body }}</textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Publish Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="datetime"
                                value="{{ \Carbon\Carbon::parse($notice->publish_date_time)->format('Y-m-d\TH:i') }}">
                            @error('datetime')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
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
                    <div class="file-preview row" id="file-preview">
                        @foreach ($files as $file)
                        <div class="file-container">
                            <div class="d-flex align-items-center border-bottom py-2"
                                id="file-{{ $file->media_id }}">
                                @php
                                $extension = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                                $is_image = in_array($extension, ['jpg', 'jpeg', 'png']);

                                $icon = $is_image
                                ? env('MEDIA_URL') . '/' . $file->file_path
                                : env('FILE_PATH') . 'assets/img/generic/image-file-2.png';
                                @endphp
                                <a href="javascript:void(0);"
                                    class="preview-file"
                                    data-url="{{ env('MEDIA_URL') . '/' . $file->file_path }}"
                                    data-ext="{{ strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION)) }}">
                                    <img src="{{ $icon }}" style="height:40px;" alt="file">
                                </a>
                                <p class="mb-0 ms-2 flex-grow-1">{{ basename($file->file_path) }}</p>
                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-file"
                                    data-id="{{ $file->media_id }}">&times;</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-end mt-3">
            <a href="{{route('notice_list')}}" class="btn btn-outline-secondary me-2">Cancel</a>
            <button class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
<!-- File Preview Modal -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center" id="modalFileContent">

            </div>
        </div>
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

    $(document).on('click', '.remove-file', function() {
        let file_id = $(this).data('id');
        let row = $('#file-' + file_id);

        if (confirm('Are you sure you want to delete this file?')) {
            $.ajax({
                url: '/notice-file-delete/' + file_id,
                type: 'GET',
                success: function(res) {
                    if (res.success) {
                        row.remove();
                        $('#flash-message').html(`
                        <div class="alert alert-success alert-dismissible fade show mt-2">
                            ${res.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `);
                    } else {
                        alert('Could not delete file.');
                    }
                }
            });
        }
    });

    //File preview
    $(document).on('click', '.preview-file', function() {

        let fileUrl = $(this).data('url');
        let fileExt = $(this).data('ext').toLowerCase();
        let modalContent = $('#modalFileContent');

        modalContent.html('');
        if (['jpg', 'jpeg', 'png'].includes(fileExt)) {
            modalContent.html(`
            <img src="${fileUrl}" class="img-fluid rounded" style="max-height:500px;">
        `);
        } else if (fileExt === 'pdf') {
            modalContent.html(`
            <iframe src="${fileUrl}" 
                    width="100%" 
                    height="600px" 
                    style="border:none;">
            </iframe>
        `);

        } else {
            modalContent.html(`<p>Preview not available</p>`);
        }

        let modal = new bootstrap.Modal(document.getElementById('filePreviewModal'));
        modal.show();
    });
</script>
@endsection