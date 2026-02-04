<div>
    @if ($mode === 'list')
        <div class="card mt-3">
            <div class="card-header">
                <div class="ms-auto pull-left">
                    <h5 class="pull-left">Users</h5>
                </div>
                <div class="ms-auto pull-right">
                    <button wire:click='create' class="btn btn btn-primary">
                        <i class="bi bi-plus"></i> Add new user
                    </button>
                </div>
                <div class="clear"></div>
            </div>
            <div id="tableExample">
                <div class="table-responsive scrollbar">
                    <table class="table mb-0 data-table fs-10">
                        <thead class="bg-200">
                            <tr>
                                <th class="text-900 sort text-nowrap">Name</th>
                                <th class="text-900 sort text-nowrap">Email</th>
                                <th class="text-900 sort text-nowrap">Number</th>
                                <th class="text-900 sort text-nowrap">Role</th>
                                <th class="text-900 sort text-nowrap">Status</th>
                                <th class="text-900 sort text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody id="user_filter_data">
                            @if ($users->isNotEmpty())
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->number }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            <x-badge-pill :label="$user->status" :status_type="$user->status === 'Active' ? 'success' : 'danger'" />
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button wire:click="edit({{ $user->id }})"
                                                    class="btn btn-outline-danger">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-outline-primary">
                                                    <i class="bi bi-key"></i>
                                                </button>
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
                </div>
            </div>
        </div>
    @else
        <div class="card mt-3">
            <div class="card-header">
                <div class="ms-auto pull-left">
                    <h5 class="pull-left"> {{ $mode === 'edit' ? 'Edit User' : 'Add New User' }} </h5>
                </div>
                <div class="ms-auto pull-right">
                    <x-back-btn :url="route('users')" btn_class="btn-outline-primary" icon="bi-arrow-left" title="Back" />
                </div>
                <div class="clear"></div>
            </div>

            <form wire:submit.prevent="store">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        wire:model.defer="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        wire:model.defer="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="number" id="number"
                                        wire:model.defer="number">
                                    @error('number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if ($mode === 'create')
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Set Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            wire:model.defer="password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            @if ($mode === 'edit')
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label"> Status <span class="text-danger">*</span></label>
                                        <select wire:model="status" class="form-select p-2 border border-dark">
                                            <option value="">Select Status</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                        @error('role_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            @if (Auth::user()->user_role_id == 1)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Role <span class="text-danger">*</span></label>
                                        <select wire:model="role_id" class="form-select p-2 border border-dark"
                                            required>
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="mt-2">
                            <div class="content-header pt-2">
                                <h5 class="pull-left">Set permissions</h5>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                @foreach ($module_manage as $module => $perms)
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-none border border-secondary">
                                            <div class="card-header d-flex justify-content-between align-items-center cursor-pointer"
                                                onclick="document.getElementById('module_access{{ $perms->id }}').click();">
                                                <strong>{{ ucfirst(str_replace('_', ' ', $perms->name)) }}</strong>
                                                <input type="checkbox" wire:model="module_access"
                                                    id="module_access{{ $perms->id }}"
                                                    value="{{ $perms->id }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('users') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    @endif
</div>
