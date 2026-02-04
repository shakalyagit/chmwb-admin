<div class="offcanvas offcanvas-end" tabindex="-1" id="filterOffcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Filter User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="user_filter">
            <div class="mb-3 apply-button">
                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i> Apply</button>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label">Division</label>
                    <select name="division_id" id="division_id" class="form-select">
                        <option value="">Select division</option>
                        @if(count($divisions)>0)
                        @foreach($divisions as $division)
                        <option value="{{$division->division_id}}">{{$division->division_name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select name="role_id" id="role_id" class="form-select">
                        <option value="">Select role</option>
                        @if(count($roles)>0)
                        @foreach($roles as $role)
                        <option value="{{$role->role_id}}">{{$role->role_name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">Select</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>