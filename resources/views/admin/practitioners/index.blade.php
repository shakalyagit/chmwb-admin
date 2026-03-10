@extends('admin.layouts.main')
@section('content')
<x-flash-message />
@if($errors->has('practitioner_file'))
<div class="alert alert-danger border border-danger alert-dismissible fade show mt-3" role="alert">
    {{ $errors->first('practitioner_file') }}
    <button type="button" class="btn-close text-danger" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row mt-3 text-end">
    <div class="ms-auto pull-right">
        <a href="{{route('download_sample_excel')}}" class="btn btn btn-outline-primary">
            <i class="bi bi-download"></i> Download Sample Excel
        </a>
        <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="bi bi-upload"></i> Upload Excel
        </button>
        <a href="{{route('add_practitioner')}}" class="btn btn btn-primary">
            <i class="bi bi-plus"></i> Add practitioner
        </a>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">
        <div class="ms-auto pull-left d-flex align-items-center">
            <a href="{{ route('practitioners_list') }}" title="Refresh" style="color: #5E6E82;"><span
                    class="bi bi-arrow-clockwise fs-6 cursor-pointer"></span>
            </a>
            <span class="bi bi-funnel fs-6 cursor-pointer" title="Filter" data-bs-toggle="offcanvas"
                data-bs-target="#filterOffcanvas"></span>
            <h5 class="pull-left">Practitioners List</h5>
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
                    @if($practitioners->isNotEmpty())
                    @foreach($practitioners as $practitioner)
                    <tr>
                        <td>{{ $practitioner->registration_no }}</td>
                        <td>{{ date('d-m-Y',strtotime($practitioner->registration_date)) }}</td>
                        <td>{{ $practitioner->name }}</td>
                        <td>{{ $practitioner->ph_no }}</td>
                        <td>{{ $practitioner->qualification }}</td>
                        <td>
                            <x-badge-pill :label="$practitioner->status" :status_type="$practitioner->status === 'Active' ? 'success' : 'danger'" />
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{route('edit_practitioner', Crypt::encrypt($practitioner->id))}}"
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
                {{ $practitioners->links('pagination::bootstrap-5') }}
            </div>
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
@include('admin.practitioners.off_canvas')
@endsection
@section('scripts')
<script>
    $(document).on('submit', '#practitioner_filter', function(e) {
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
            url: "{{ route('practitioner_filter') }}?page=" + page,
            type: "GET",
            data: $('#practitioner_filter').serialize(),
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
        let params = $('#practitioner_filter').serialize();
        let url = "{{ route('export_practitioners') }}?" + params;
        window.location.href = url;
    });
</script>
@endsection