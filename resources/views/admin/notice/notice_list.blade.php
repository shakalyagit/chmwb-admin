@extends('admin.layouts.main')
@section('content')
<x-flash-message />
<div class="card mt-3">
    <div class="card-header">
        <div class="ms-auto pull-left d-flex align-items-center">
            <a href="{{ route('notice_list') }}" title="Refresh" style="color: #5E6E82;"><span
                    class="bi bi-arrow-clockwise fs-6 cursor-pointer"></span>
            </a>
            <span class="bi bi-funnel fs-6 cursor-pointer" title="Filter" data-bs-toggle="offcanvas"
                data-bs-target="#filterOffcanvas"></span>
            <h5 class="pull-left">Notice List</h5>
        </div>
        <div class="ms-auto pull-right">
            @if(auth()->user()->name == 'Admin')
            <a href="{{route('add_notice')}}" class="btn btn btn-primary">
                <i class="bi bi-plus"></i> Add notice
            </a>
            @endif
        </div>
        <div class="clear"></div>
    </div>
    <div id="tableExample">
        <div class="table-responsive scrollbar">
            <table class="table mb-0 data-table fs-10">
                <thead class="bg-200">
                    <tr>
                        <th class="text-900 sort text-nowrap">ID</th>
                        <th class="text-900 sort text-nowrap">Notice Type</th>
                        <th class="text-900 sort text-nowrap">Notice Subject</th>
                        <th class="text-900 sort text-nowrap">Publish Date Time</th>
                        <th class="text-900 sort text-nowrap">Status</th>
                        <th class="text-900 sort text-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody id="notice_filter_data">
                    @if($notices->isNotEmpty())
                    @foreach($notices as $notice)
                    <tr>
                        <td>{{ $notice->id }}</td>
                        <td>{{ $notice->notice_type }}</td>
                        <td>{{ $notice->notice_subject }}</td>
                        <td>{{ date('d-m-Y', strtotime($notice->publish_date_time)) }}</td>
                        <td>
                            <x-badge-pill :label="$notice->status" :status_type="$notice->status === 'Publish' ? 'success' : 'danger'" />
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{route('edit_notice', Crypt::encrypt($notice->id))}}"
                                    class="btn btn-outline-danger">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center">No record Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-3 px-2" id="pagination_links"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('upload_practitioner_excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Upload Practitioners Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="file" name="practitioner_file" accept=".xlsx" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.notice.off_canvas')
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        loadData();
    });

    // Pagination click
    $(document).on('click', '#pagination_links .pagination a', function(e) {
        e.preventDefault();

        let page = $(this).attr('href').split('page=')[1];
        loadData(page);
    });

    function loadData(page = 1) {
        let formData = $('#notice_filter').serialize();

        $.ajax({
            url: "{{ route('notice_filter') }}?page=" + page,
            type: "POST",
            data: formData,
            beforeSend: function() {
                $('#notice_filter_data').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
            },
            success: function(res) {
                $('#notice_filter_data').html(res.html);
                $('#pagination_links').html(res.pagination);

                var off_canvas_element = document.getElementById('filterOffcanvas');
                var off_canvas_instance = bootstrap.Offcanvas.getInstance(off_canvas_element);
                if (off_canvas_instance) {
                    off_canvas_instance.hide();
                }
            }
        });
    }

    // Filter submit
    $('#notice_filter').on('submit', function(e) {
        e.preventDefault();
        loadData();
    });
</script>
@endsection