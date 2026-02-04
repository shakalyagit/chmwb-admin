<div>
    <x-flash-message />
    {{-- List Mode --}}
    @if ($mode === 'list')
        <div class="card mt-3">
            <div class="card-header">
                <div class="ms-auto pull-left">
                    <h5 class="pull-left">Patient Master</h5>
                </div>
                <div class="ms-auto pull-right">
                    <button wire:click='create' class="btn btn-primary">
                        <i class="bi bi-plus"></i> Add New Patient
                    </button>
                </div>
                <div class="clear"></div>
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <input type="text" class="form-control" wire:model="filters.patient_name"
                            placeholder="Patient Name">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" wire:model="filters.patient_number"
                            placeholder="Patient Number">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" wire:model="filters.city" placeholder="City">
                    </div>
                    <div class="col">
                        <button wire:click="applyFilter" class="btn btn-outline-danger">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                        <button type="button" wire:click="resetFilter" class="btn btn-outline-warning">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3 table-responsive scrollbar">
            <table class="table table-bordered table-striped fs-10 mb-0">
                <thead>
                    <tr class="bg-300">
                        <th>Name</th>
                        <th>Number</th>
                        <th class="no-wrap-space">City</th>
                        <th class="no-wrap-space">State</th>
                        <th class="no-wrap-space">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $item)
                        <tr>
                            <td class="no-wrap-space">{{ $item->patient_name }}</td>
                            <td>{{ $item->patient_number }}</td>
                            <td>{{ $item->city }}</td>
                            <td>{{ $item->state }}</td>
                            <td class="no-wrap-space">
                                <button class="btn btn-sm btn-outline-primary" wire:click="edit({{ $item->id }})">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" wire:click="delete({{ $item->id }})"
                                    wire:confirm="Are you sure you want to delete this patient?">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="container-fluid">
                {{ $patients->links() }}
            </div>
        </div>
    @endif

    {{-- Create/Edit Mode --}}
    @if ($mode === 'create' || $mode === 'edit')
        <div class="card mt-5 mb-4 p-3">
            <div class="card-header">
                <div class="ms-auto pull-left">
                    <h5 class="pull-left">{{ $mode === 'edit' ? 'Edit Patient' : 'Add New Patient' }}</h5>
                </div>
                <div class="ms-auto pull-right">
                    <button wire:click="cancel" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Back
                    </button>
                </div>
                <div class="clear"></div>
            </div>

            <div class="card-body">
                <form wire:submit.prevent="{{ $mode === 'edit' ? 'update' : 'store' }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Patient Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="patient_name" class="form-control">
                            @error('patient_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label>Patient Number <span class="text-danger">*</span></label>
                            <input type="text" wire:model="patient_number" class="form-control">
                            @error('patient_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label>City</label>
                            <input type="text" wire:model="city" class="form-control">
                            @error('city')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label>State <span class="text-danger">*</span></label>
                            <input type="text" wire:model="state" class="form-control">
                            @error('state')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12 text-end">
                            <button type="button" wire:click="cancel" class="btn btn-outline-danger">
                                <i class="bi bi-x-circle"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> {{ $mode === 'edit' ? 'Update' : 'Save' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
