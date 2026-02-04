<div>

    <x-flash-message />

    {{-- List Mode --}}
    @if ($mode === 'list')
        <div class="card mt-3">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Order List</h5>
                    <button wire:click="create" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Generate Bill
                    </button>
                </div>
            </div>

            {{-- Filter Section --}}
            <div class="card-body row mt-3 mb-5">
                <div class="col-md-3">
                    <input type="text" class="form-control" wire:model.live.debounce.300ms="filters.patient_name"
                        placeholder="Patient Name">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" wire:model.live.debounce.300ms="filters.patient_number"
                        placeholder="Patient Number">
                </div>
                <div class="col-md-3">
                    <select class="form-control" wire:model.live="filters.payment_status">
                        <option value="">All Payment Status</option>
                        <option value="Full Paid">Full Paid</option>
                        <option value="Part Paid">Part Paid</option>
                        <option value="Unpaid">Unpaid</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button wire:click="resetFilter" class="btn btn-outline-warning">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </button>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-300">
                            <th>Invoice No</th>
                            <th>Patient Name</th>
                            <th>Patient Number</th>
                            <th>Total Amount</th>
                            <th>Discount</th>
                            <th>Payable Amount</th>
                            <th>Payment Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->invoice_no }}</td>
                                <td>{{ $order->patient->patient_name }}</td>
                                <td>{{ $order->patient->patient_number }}</td>
                                <td>₹{{ number_format($order->total_bill_amount, 2) }}</td>
                                <td>{{ $order->discount_percentage }}%
                                    (₹{{ number_format($order->discount_amount, 2) }})
                                </td>
                                <td>₹{{ number_format($order->payable_amount, 2) }}</td>
                                <td>
                                    <span
                                        class="badge
                                            @if ($order->payment_status == 'Full Paid') bg-success
                                            @elseif($order->payment_status == 'Part Paid') bg-warning
                                            @else bg-danger @endif">
                                        {{ $order->payment_status }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                <td class="no-wrap-space">
                                    <button class="btn btn-sm btn-outline-primary"
                                        wire:click="edit({{ $order->id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="{{ route('invoice.print', $order->id) }}" target="_blank"
                                        class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger"
                                        wire:click="delete({{ $order->id }})"
                                        wire:confirm="Are you sure you want to delete this order?">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">No orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    @endif

    {{-- Create/Edit Mode --}}
    @if ($mode === 'create' || $mode === 'edit')
        <div class="card mt-3">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>{{ $mode === 'edit' ? 'Edit Order' : 'Generate Bill' }}</h5>
                    <button wire:click="cancel" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-primary-subtle text-primary">
                                <h6 class="mb-0">Patient Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 position-relative">
                                    <label>Patient Name <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.live.debounce.300ms="patient_name"
                                        class="form-control" placeholder="Search patient by name or number">
                                    @error('patient_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    {{-- Patient Suggestions --}}
                                    @if ($showPatientSuggestions && count($patientSuggestions) > 0)
                                        <div class="list-group position-absolute w-100" style="z-index: 1000;">
                                            @foreach ($patientSuggestions as $patient)
                                                <button type="button" wire:click="selectPatient({{ $patient->id }})"
                                                    class="list-group-item list-group-item-action">
                                                    <strong>{{ $patient->patient_name }}</strong><br>
                                                    <small>{{ $patient->patient_number }} |
                                                        {{ $patient->city }}</small>
                                                </button>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label>Patient Number <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="patient_number" class="form-control">
                                    @error('patient_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>City</label>
                                    <input type="text" wire:model="patient_city" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>State</label>
                                    <input type="text" wire:model="patient_state" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-success-subtle text-success">
                                <h6 class="mb-0">Medicine Details</h6>
                            </div>
                            <div class="card-body">
                                @foreach ($medicineRows as $index => $row)
                                    <div class="border p-3 mb-3 rounded position-relative">
                                        <button type="button" wire:click="removeMedicineRow({{ $index }})"
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2"
                                            @if (count($medicineRows) == 1) disabled @endif>
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <div class="row">
                                            <div class="col-md-6 mb-2 position-relative">
                                                <label>Medicine Name <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    wire:model.debounce.500ms="medicineRows.{{ $index }}.medicine_name"
                                                    wire:keyup.debounce.500ms="searchMedicineByIndex({{ $index }}, $event.target.value)"
                                                    class="form-control" placeholder="Search medicine">

                                                {{-- Medicine Suggestions --}}
                                                @if (!empty($showMedicineSuggestions[$index]) && !empty($medicineSuggestions[$index]))
                                                    <div class="list-group position-absolute w-100"
                                                        style="z-index: 1000; max-height: 200px; overflow-y: auto;">
                                                        @foreach ($medicineSuggestions[$index] as $medicine)
                                                            <button type="button"
                                                                wire:click="selectMedicine({{ $index }}, {{ $medicine->id }})"
                                                                class="list-group-item list-group-item-action">
                                                                <strong>{{ $medicine->name }}</strong><br>
                                                                <small>{{ $medicine->generic_name }} | Stock:
                                                                    {{ $medicine->total_stock }} |
                                                                    ₹{{ $medicine->per_stock_mrp }}</small>
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                @elseif (!empty($showMedicineSuggestions[$index]))
                                                    <div class="alert alert-warning mt-2 small">No medicine found</div>
                                                @endif

                                                @error('medicineRows.' . $index . '.medicine_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-2 mb-2">
                                                <label>Price</label>
                                                <input type="number"
                                                    wire:model="medicineRows.{{ $index }}.price"
                                                    class="form-control" step="0.01" readonly>
                                            </div>

                                            {{-- <div class="col-md-2 mb-2">
                                                <label>QTY <span class="text-danger">*</span></label>
                                                <input type="number"
                                                    wire:model.live="medicineRows.{{ $index }}.qty"
                                                    class="form-control" min="1">
                                            </div> --}}

                                            <div class="col-md-2 mb-2">
                                                <label>QTY <span class="text-danger">*</span></label>
                                                <input type="number"
                                                    wire:model.blur="medicineRows.{{ $index }}.qty"
                                                    class="form-control" min="1"
                                                    max="{{ $row['available_stock'] ?? 999999 }}">
                                                @error('medicineRows.' . $index . '.qty')
                                                    <small class="text-danger d-block">{{ $message }}</small>
                                                @enderror
                                                @if (!empty($row['available_stock']))
                                                    <small class="text-muted">Stock:
                                                        {{ $row['available_stock'] }}</small>
                                                @endif
                                            </div>

                                            <div class="col-md-2 mb-2">
                                                <label>Total</label>
                                                <input type="number"
                                                    wire:model="medicineRows.{{ $index }}.grand_total"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <button type="button" wire:click="addMedicineRow"
                                    class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-plus-circle"></i> Add More Medicine
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Billing Summary --}}
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6>Total Amount:</h6>
                                        <h4 class="text-primary">₹{{ number_format($total_bill_amount, 2) }}</h4>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Discount (%)</label>
                                        <input type="number" wire:model.blur="discount_percentage"
                                            class="form-control" step="0.01" min="0" max="100">
                                        <small class="text-muted">Discount Amount:
                                            ₹{{ number_format($discount_amount, 2) }}</small>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Payable Amount:</h6>
                                        <h4 class="text-success">₹{{ number_format($payable_amount, 2) }}</h4>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Paid Amount</label>
                                        <input type="number" wire:model="paid_amount" class="form-control"
                                            step="0.01" min="0">
                                        <select wire:model="payment_status" class="form-control mt-2">
                                            <option value="Unpaid">Unpaid</option>
                                            <option value="Part Paid">Part Paid</option>
                                            <option value="Full Paid">Full Paid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="row mt-3">
                    <div class="col-md-12 text-end">
                        <button type="button" wire:click="cancel" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </button>
                        <button type="button" wire:click="{{ $mode === 'edit' ? 'update' : 'checkout' }}"
                            class="btn btn-success">
                            <i class="bi bi-check-circle"></i> {{ $mode === 'edit' ? 'Update Order' : 'Checkout' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
