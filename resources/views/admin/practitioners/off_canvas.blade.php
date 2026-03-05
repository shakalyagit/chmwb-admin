<div class="offcanvas offcanvas-end" tabindex="-1" id="filterOffcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Filter Practitioner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="practitioner_filter">
            @csrf
            <div class="mb-3 apply-button">
                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i> Apply</button>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label">Registration No</label>
                    <input type="text" name="reg_no" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label">Registration Date</label>
                    <input type="date" name="to_date" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Select</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
        </form>
    </div>
</div>