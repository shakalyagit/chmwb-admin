<div>
    <x-flash-message />

    @if ($mode === 'list')
        <div class="card mt-3">
            <div class="card-header">
                <div class="ms-auto pull-left">
                    <h5 class="pull-left">Medicine Master</h5>
                </div>
                <div class="ms-auto pull-right">
                    <button wire:click='create' class="btn btn btn-primary">
                        <i class="bi bi-plus"></i> Add new Medicine
                    </button>
                </div>
                <div class="clear"></div>
                <!-- Filters -->
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <input type="text" class="form-control" wire:model.live.debounce.100ms="filters.medicin_id"
                            placeholder="Medicine ID">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" wire:model.live.debounce.100ms="filters.name"
                            placeholder="Medicine Name">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" wire:model.live.debounce.100ms="filters.generic_name"
                            placeholder="Generic Name">
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" wire:model.live.debounce.100ms="filters.expire_date"
                            placeholder="Expire Date">
                    </div>
                    <div class="col">
                        <button wire:click="applyFilter" class="btn btn-outline-danger">Filter</button>
                        <button type="button" wire:click="resetFilter" class="btn btn-outline-warning"><i
                                class="bi bi-arrow-clockwise"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="card mt-3 table-responsive scrollbar">
                <table class="table table-bordered table-striped fs-10 mb-0">
                    <thead>
                        <tr class="bg-300">
                            <th class="no-wrap-space">Med ID</th>
                            <th class="">Name</th>
                            <th class="">Generic</th>
                            <th class="no-wrap-space">HSN</th>
                            <th class="no-wrap-space">Batch</th>
                            <th class="no-wrap-space">Expire</th>
                            <th class="no-wrap-space">Total File</th>
                            <th class="no-wrap-space">Qty/File</th>
                            <th class="no-wrap-space">File MRP</th>
                            <th class="no-wrap-space">Stock</th>
                            <th class="no-wrap-space">Stock MRP</th>
                            <th class="no-wrap-space">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($medicines as $item)
                            <tr>
                                <td class="no-wrap-space">{{ $item->medicin_id }}</td>
                                <td class="">{{ $item->name }}</td>
                                <td class="">{{ $item->generic_name }}</td>
                                <td class="no-wrap-space">{{ $item->hsn_code }}</td>
                                <td class="no-wrap-space">{{ $item->batch_no }}</td>
                                <td class="no-wrap-space">{{ date('d-m-Y', strtotime($item->expire_date)) }}</td>
                                <td class="no-wrap-space">{{ $item->total_file }}</td>
                                <td class="no-wrap-space">{{ $item->qty_per_file }}</td>
                                <td class="no-wrap-space">{{ $item->per_file_mrp }}</td>
                                <td class="no-wrap-space"> <x-badge-pill :label="'Q - ' . $item->total_stock" status_type='success' />
                                </td>
                                <td class="no-wrap-space">
                                    <x-badge-pill :label="'₹ ' . number_format($item->per_stock_mrp, 2)" status_type="primary" />
                                </td>
                                <td class="no-wrap-space">
                                    <button class="btn btn-sm btn-outline-primary"
                                        wire:click="edit({{ $item->id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger"
                                        wire:click="delete({{ $item->id }})"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center text-muted">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="container-fluid">
                    {{ $medicines->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="card mt-5 mb-4 p-3">
            <div class="card-header">
                <div class="ms-auto pull-left">
                    <h5 class="pull-left"> {{ $mode === 'edit' ? 'Edit Medicine' : 'Add New Medicine' }} </h5>
                </div>
                <div class="ms-auto pull-right">
                    <x-back-btn :url="route('medicine_list')" btn_class="btn-outline-primary" icon="bi-arrow-left" title="Back" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <form wire:submit.prevent="{{ $mode === 'edit' ? 'update' : 'store' }}">
                <div class="row">
                    <div class="col-md-3">
                        <label>Medicine ID</label>
                        <input type="text" wire:model="medicin_id" class="form-control">
                        @error('medicin_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label>Medicine Name</label>
                        <input type="text" wire:model="name" class="form-control">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label>Generic Name</label>
                        <input type="text" wire:model="generic_name" class="form-control">
                        @error('generic_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label>HSN Code</label>
                        <input type="text" wire:model="hsn_code" class="form-control">
                        @error('hsn_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label>Batch No</label>
                        <input type="text" wire:model="batch_no" class="form-control">
                        @error('batch_no')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label>Expire Date</label>
                        <input type="date" wire:model="expire_date" class="form-control">
                        @error('expire_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label>Total File</label>
                        <input type="number" wire:model.blur="total_file" class="form-control total_file">
                        @error('total_file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label>Qty per File</label>
                        <input type="number" wire:model.blur="qty_per_file" class="form-control qty_per_file">
                        @error('qty_per_file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label>Per File MRP</label>
                        <input type="number" wire:model.blur="per_file_mrp" step="0.01"
                            class="form-control mrp_per_file">
                        @error('per_file_mrp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label>Total Stock</label>
                        <input type="number" wire:model="total_stock" class="form-control total_stock">
                        @error('total_stock')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label>Per Stock MRP</label>
                        <input type="number" wire:model="per_stock_mrp" step="0.01"
                            class="form-control per_stock_mrp">
                        @error('per_stock_mrp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="button" wire:click="resetForm" class="btn btn-outline-danger">Cancel</button>
                    <button type="submit" class="btn btn-primary ms-3">
                        {{ $mode === 'edit' ? 'Update Medicine' : 'Save Medicine' }}
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>
