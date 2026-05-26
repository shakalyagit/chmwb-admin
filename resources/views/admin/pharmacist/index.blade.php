@extends('admin.layouts.main')
@section('content')
<x-flash-message />
{{-- Row-level import errors --}}
@if ($errors->has('import_errors'))
    <div class="alert alert-warning mt-3">
        <strong>Some rows were skipped due to missing required fields:</strong>
        <ul class="mb-0 mt-1">
            @foreach ((array) $errors->get('import_errors') as $error)
                @foreach ((array) $error as $message)
                    <li>{{ $message }}</li>
                @endforeach
            @endforeach
        </ul>
    </div>
@endif

{{-- File-level error (e.g. corrupt file) --}}
@error('pharmacist_file')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="row mt-3 text-end">
    <div class="ms-auto pull-right">
        <a href="{{route('download_sample_pharmacist_excel')}}" class="btn btn btn-outline-primary">
            <i class="bi bi-download"></i> Download Sample Excel
        </a>
        <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="bi bi-upload"></i> Upload Excel
        </button>
        <a href="{{route('add_pharmacist')}}" class="btn btn btn-primary">
            <i class="bi bi-plus"></i> Add pharmacist
        </a>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">
        <div class="ms-auto pull-left d-flex align-items-center">
            <a href="{{ route('pharmacist_list') }}" title="Refresh" style="color: #5E6E82;"><span
                    class="bi bi-arrow-clockwise fs-6 cursor-pointer"></span>
            </a>
            <span class="bi bi-funnel fs-6 cursor-pointer" title="Filter" data-bs-toggle="offcanvas"
                data-bs-target="#filterOffcanvas"></span>
            <h5 class="pull-left">Pharmacist List</h5>
        </div>
        <div class="ms-auto pull-right">
            @if(auth()->user()->name == 'Admin')
            <button type="button" id="exportBtn" class="btn btn-outline-primary">
                <i class="bi bi-download"></i> Export to Excel
            </button>
            @endif
        </div>
        <div class="clear"></div>
    </div>
    <div id="tableExample">
        <div class="table-responsive scrollbar">
            <table class="table mb-0 data-table fs-10">
                <thead class="bg-200">
                    <tr>
                        <th class="text-900 sort text-nowrap">Registration No.</th>
                        <th class="text-900 sort text-nowrap">Registration Date</th>
                        <th class="text-900 sort text-nowrap">Name</th>
                        <th class="text-900 sort text-nowrap">Phone</th>
                        <th class="text-900 sort text-nowrap">Qualification</th>
                        <th class="text-900 sort text-nowrap">Status</th>
                        <th class="text-900 sort text-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody id="user_filter_data">
                    @if($pharmacists->isNotEmpty())
                    @foreach($pharmacists as $pharmacist)
                    <tr>
                        <td>{{ $pharmacist->registration_number }}</td>
                        <td>{{ date('d-m-Y',strtotime($pharmacist->date_of_registration)) }}</td>
                        <td>{{ $pharmacist->name }}</td>
                        <td>{{ $pharmacist->mobile_number ?? 'N/A' }}</td>
                        <td>{{ $pharmacist->qualification_name ?? 'N/A' }}</td>
                        <td>
                            <x-badge-pill :label="$pharmacist->status" :status_type="$pharmacist->status === 'Active' ? 'success' : 'danger'" />
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{route('edit_pharmacist', Crypt::encrypt($pharmacist->id))}}"
                                    class="btn btn-outline-danger">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="text-center">No record Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div id="pagination_links" class="px-2">
                {{ $pharmacists->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('upload_pharmacist_excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Upload Pharmacist Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="file" name="pharmacist_file" accept=".xlsx" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.pharmacist.off_canvas')
@endsection
@section('scripts')
<script>
    $(document).on('submit', '#pharmacist_filter', function(e) {
        e.preventDefault();
        fetchData();
    });

    $(document).on('click', '#pagination_links a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchData(page);
    });

    function fetchData(page = 1) {
        $.ajax({
            url: "{{ route('pharmacist_filter') }}?page=" + page,
            type: "GET",
            data: $('#pharmacist_filter').serialize(),
            beforeSend: function() {
                $('#user_filter_data').html(
                    '<tr><td colspan="7" class="text-center">Loading...</td></tr>'
                );
            },
            success: function(res) {
                $('#user_filter_data').html(res.html);
                $('#pagination_links').html(res.pagination);
                var off_canvas_element = document.getElementById('filterOffcanvas');
                var off_canvas_instance = bootstrap.Offcanvas.getInstance(off_canvas_element);
                off_canvas_instance.hide();
            }
        });
    }

    $('#exportBtn').click(function() {
        let params = $('#pharmacist_filter').serialize();
        let url = "{{ route('export_pharmacists') }}?" + params;
        window.location.href = url;
    });
</script>
@endsection