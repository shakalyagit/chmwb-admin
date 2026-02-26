@extends('admin.layouts.main')
@section('content')
<x-flash-message />
@if($errors->has('practitioner_file'))
<div class="alert alert-danger border border-danger alert-dismissible fade show mt-3" role="alert">
    {{ $errors->first('practitioner_file') }}
    <button type="button" class="btn-close text-danger" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card mt-3">
    <div class="card-header">
        <div class="ms-auto pull-left">
            <h5 class="pull-left">Users</h5>
        </div>
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
            {{ $practitioners->links('pagination::bootstrap-5') }}
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
@endsection