<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\MedicianeMst;
use App\Models\OrderDetail;
use App\Models\OrderMst;
use App\Models\PatientMst;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

// class CheckoutModule extends Component
// {
//     use WithPagination;

//     public $mode = 'list';
//     protected $paginationTheme = 'bootstrap';

//     // Patient Fields
//     public $patient_id;
//     public $patient_name = '';
//     public $patient_number = '';
//     public $patient_city = '';
//     public $patient_state = 'West Bengal';
//     public $patientSuggestions = [];
//     public $showPatientSuggestions = false;

//     // Medicine Fields
//     public $medicineRows = [];
//     public $medicineSuggestions = [];
//     public $showMedicineSuggestions = [];
//     public $searchMedicine = [];

//     // Billing Fields
//     public $total_bill_amount = 0;
//     public $discount_percentage = 0;
//     public $discount_amount = 0;
//     public $payable_amount = 0;
//     public $paid_amount = 0;
//     public $payment_status = 'Unpaid';

//     public $filters = [
//         'patient_name' => '',
//         'patient_number' => '',
//         'payment_status' => '',
//     ];

//     // Edit Mode
//     public $edit_order_id;

//     protected $rules = [
//         'patient_name' => 'required|string|max:255',
//         'patient_number' => 'required|string|max:255',
//         'medicineRows.*.medicine_id' => 'required|exists:mediciane_msts,id',
//         'medicineRows.*.qty' => 'required|integer|min:1',
//         'medicineRows.*.price' => 'required|numeric|min:0',
//     ];

//     public function mount()
//     {
//         $this->addMedicineRow();
//     }

//     // Patient Search
//     public function updatedPatientName($value)
//     {
//         if (strlen($value) >= 2) {
//             $this->patientSuggestions = PatientMst::where('patient_name', 'like', "%{$value}%")
//                 ->orWhere('patient_number', 'like', "%{$value}%")
//                 ->limit(10)
//                 ->get();
//             $this->showPatientSuggestions = true;
//         } else {
//             $this->showPatientSuggestions = false;
//         }
//     }

//     public function selectPatient($patientId)
//     {
//         $patient = PatientMst::find($patientId);
//         if ($patient) {
//             $this->patient_id = $patient->id;
//             $this->patient_name = $patient->patient_name;
//             $this->patient_number = $patient->patient_number;
//             $this->patient_city = $patient->city;
//             $this->patient_state = $patient->state;
//             $this->showPatientSuggestions = false;
//         }
//     }

//     // Medicine Search
//     // public function searchMedicineByIndex($index, $value)
//     // {
//     //     if (strlen($value) >= 2) {
//     //         $this->medicineSuggestions[$index] = MedicianeMst::where('name', 'like', "%{$value}%")
//     //             ->orWhere('generic_name', 'like', "%{$value}%")
//     //             ->limit(10)
//     //             ->get();
//     //         $this->showMedicineSuggestions[$index] = true;
//     //     } else {
//     //         $this->showMedicineSuggestions[$index] = false;
//     //     }
//     // }

//     public function searchMedicineByIndex($index, $value)
//     {
//         $this->medicineRows[$index]['medicine_name'] = $value;

//         if (strlen($value) >= 2) {
//             $this->medicineSuggestions[$index] = MedicianeMst::where('name', 'like', "%{$value}%")
//                 ->orWhere('generic_name', 'like', "%{$value}%")
//                 ->where('total_stock', '>', 0)  // শুধু stock আছে এমন medicine
//                 ->limit(10)
//                 ->get();
//             $this->showMedicineSuggestions[$index] = true;
//         } else {
//             $this->showMedicineSuggestions[$index] = false;
//             $this->medicineSuggestions[$index] = [];
//         }
//     }

//     // public function selectMedicine($index, $medicineId)
//     // {
//     //     $medicine = MedicianeMst::find($medicineId);
//     //     if ($medicine) {
//     //         $this->medicineRows[$index]['medicine_id'] = $medicine->id;
//     //         $this->medicineRows[$index]['medicine_name'] = $medicine->name;
//     //         $this->medicineRows[$index]['price'] = $medicine->per_stock_mrp;
//     //         $this->medicineRows[$index]['qty'] = 1;
//     //         $this->calculateRowTotal($index);
//     //         $this->showMedicineSuggestions[$index] = false;
//     //     }
//     // }

//     public function selectMedicine($index, $medicineId){
//         $medicine = MedicianeMst::find($medicineId);
//         if ($medicine) {
//             $this->medicineRows[$index]['medicine_id'] = $medicine->id;
//             $this->medicineRows[$index]['medicine_name'] = $medicine->name;
//             $this->medicineRows[$index]['price'] = $medicine->per_stock_mrp;
//             $this->medicineRows[$index]['qty'] = 1;
//             $this->calculateRowTotal($index);
//             $this->showMedicineSuggestions[$index] = false;

//             $this->searchMedicine[$index] = $medicine->name;
//         }
//     }

//     // Medicine Row Management
//     public function addMedicineRow()
//     {
//         $index = count($this->medicineRows);
//         $this->medicineRows[] = [
//             'medicine_id' => null,
//             'medicine_name' => '',
//             'price' => 0,
//             'qty' => 1,
//             'grand_total' => 0,
//         ];
//         $this->showMedicineSuggestions[$index] = false;
//     }

//     public function removeMedicineRow($index)
//     {
//         unset($this->medicineRows[$index]);
//         $this->medicineRows = array_values($this->medicineRows);
//         $this->calculateTotals();
//     }

//     public function updatedMedicineRows($value, $key)
//     {
//         $parts = explode('.', $key);
//         if (count($parts) == 2 && $parts[1] == 'qty') {
//             $index = $parts[0];
//             $this->calculateRowTotal($index);
//         }
//     }

//     private function calculateRowTotal($index)
//     {
//         if (isset($this->medicineRows[$index])) {
//             $qty = $this->medicineRows[$index]['qty'] ?? 0;
//             $price = $this->medicineRows[$index]['price'] ?? 0;
//             $this->medicineRows[$index]['grand_total'] = $qty * $price;
//             $this->calculateTotals();
//         }
//     }

//     // Calculate Discount
//     public function updatedDiscountPercentage($value)
//     {
//         $this->calculateTotals();
//     }

//     private function calculateTotals()
//     {
//         $this->total_bill_amount = collect($this->medicineRows)->sum('grand_total');
//         $this->discount_amount = ($this->total_bill_amount * $this->discount_percentage) / 100;
//         $this->payable_amount = $this->total_bill_amount - $this->discount_amount;
//     }

//     // Create New Billing
//     public function create()
//     {
//         $this->resetForm();
//         $this->mode = 'create';
//     }

//     // Checkout Process
//     public function checkout()
//     {
//         $this->validate();

//         try {
//             DB::beginTransaction();

//             // Save or Update Patient
//             if ($this->patient_id) {
//                 $patient = PatientMst::find($this->patient_id);
//                 $patient->update([
//                     'patient_name' => $this->patient_name,
//                     'patient_number' => $this->patient_number,
//                     'city' => $this->patient_city,
//                     'state' => $this->patient_state,
//                 ]);
//             } else {
//                 $patient = PatientMst::create([
//                     'patient_name' => $this->patient_name,
//                     'patient_number' => $this->patient_number,
//                     'city' => $this->patient_city,
//                     'state' => $this->patient_state,
//                 ]);
//                 $this->patient_id = $patient->id;
//             }

//             // Generate Invoice Number
//             $invoiceNo = 'INV-' . date('Ymd') . '-' . str_pad(OrderMst::count() + 1, 4, '0', STR_PAD_LEFT);

//             // Create Order
//             $order = OrderMst::create([
//                 'patient_id' => $this->patient_id,
//                 'invoice_no' => $invoiceNo,
//                 'total_bill_amount' => $this->total_bill_amount,
//                 'discount_percentage' => $this->discount_percentage,
//                 'discount_amount' => $this->discount_amount,
//                 'payable_amount' => $this->payable_amount,
//                 'paid_amount' => $this->paid_amount,
//                 'payment_status' => $this->payment_status,
//                 'shop_id' => Auth::user()->shop_id,
//             ]);

//             // Create Order Details
//             foreach ($this->medicineRows as $row) {
//                 if (!empty($row['medicine_id'])) {
//                     OrderDetail::create([
//                         'patient_id' => $this->patient_id,
//                         'order_id' => $order->id,
//                         'medicine_id' => $row['medicine_id'],
//                         'qty' => $row['qty'],
//                         'price' => $row['price'],
//                         'total_amount' => $row['grand_total'],
//                     ]);

//                     // Update Medicine Stock
//                     $medicine = MedicianeMst::find($row['medicine_id']);
//                     $medicine->total_stock -= $row['qty'];
//                     $medicine->save();
//                 }
//             }

//             DB::commit();
//             session()->flash('success', 'Order created successfully! Invoice: ' . $invoiceNo);
//             $this->resetForm();
//             $this->mode = 'list';
//         } catch (\Exception $e) {
//             DB::rollBack();
//             session()->flash('error', 'Something went wrong: ' . $e->getMessage());
//         }
//     }

//     // Edit Order
//     public function edit($orderId)
//     {
//         $order = OrderMst::with('orderDetails.medicine', 'patient')->findOrFail($orderId);

//         $this->edit_order_id = $order->id;
//         $this->patient_id = $order->patient_id;
//         $this->patient_name = $order->patient->patient_name;
//         $this->patient_number = $order->patient->patient_number;
//         $this->patient_city = $order->patient->city;
//         $this->patient_state = $order->patient->state;

//         $this->medicineRows = [];
//         foreach ($order->orderDetails as $detail) {
//             $this->medicineRows[] = [
//                 'medicine_id' => $detail->medicine_id,
//                 'medicine_name' => $detail->medicine->name,
//                 'price' => $detail->price,
//                 'qty' => $detail->qty,
//                 'grand_total' => $detail->total_amount,
//             ];
//         }

//         $this->discount_percentage = $order->discount_percentage;
//         $this->paid_amount = $order->paid_amount;
//         $this->payment_status = $order->payment_status;
//         $this->calculateTotals();

//         $this->mode = 'edit';
//     }

//     // Update Order
//     public function update()
//     {
//         $this->validate();

//         try {
//             DB::beginTransaction();

//             $order = OrderMst::findOrFail($this->edit_order_id);

//             // Update Patient
//             $patient = PatientMst::find($this->patient_id);
//             $patient->update([
//                 'patient_name' => $this->patient_name,
//                 'patient_number' => $this->patient_number,
//                 'city' => $this->patient_city,
//                 'state' => $this->patient_state,
//             ]);

//             // Update Order
//             $order->update([
//                 'total_bill_amount' => $this->total_bill_amount,
//                 'discount_percentage' => $this->discount_percentage,
//                 'discount_amount' => $this->discount_amount,
//                 'payable_amount' => $this->payable_amount,
//                 'paid_amount' => $this->paid_amount,
//                 'payment_status' => $this->payment_status,
//             ]);

//             // Delete old details and restore stock
//             foreach ($order->orderDetails as $detail) {
//                 $medicine = MedicianeMst::find($detail->medicine_id);
//                 $medicine->total_stock += $detail->qty;
//                 $medicine->save();
//             }
//             $order->orderDetails()->delete();

//             // Create new order details
//             foreach ($this->medicineRows as $row) {
//                 if (!empty($row['medicine_id'])) {
//                     OrderDetail::create([
//                         'patient_id' => $this->patient_id,
//                         'order_id' => $order->id,
//                         'medicine_id' => $row['medicine_id'],
//                         'qty' => $row['qty'],
//                         'price' => $row['price'],
//                         'total_amount' => $row['grand_total'],
//                     ]);

//                     // Update stock
//                     $medicine = MedicianeMst::find($row['medicine_id']);
//                     $medicine->total_stock -= $row['qty'];
//                     $medicine->save();
//                 }
//             }

//             DB::commit();
//             session()->flash('success', 'Order updated successfully!');
//             $this->resetForm();
//             $this->mode = 'list';
//         } catch (\Exception $e) {
//             DB::rollBack();
//             session()->flash('error', 'Something went wrong: ' . $e->getMessage());
//         }
//     }

//     // Delete Order
//     public function delete($orderId)
//     {
//         try {
//             DB::beginTransaction();

//             $order = OrderMst::with('orderDetails')->findOrFail($orderId);

//             // Restore stock
//             foreach ($order->orderDetails as $detail) {
//                 $medicine = MedicianeMst::find($detail->medicine_id);
//                 $medicine->total_stock += $detail->qty;
//                 $medicine->save();
//             }

//             $order->delete();

//             DB::commit();
//             session()->flash('success', 'Order deleted successfully!');
//         } catch (\Exception $e) {
//             DB::rollBack();
//             session()->flash('error', 'Something went wrong!');
//         }
//     }

//     // Reset Form
//     public function resetForm()
//     {
//         $this->patient_id = null;
//         $this->patient_name = '';
//         $this->patient_number = '';
//         $this->patient_city = '';
//         $this->patient_state = 'West Bengal';
//         $this->medicineRows = [];
//         $this->total_bill_amount = 0;
//         $this->discount_percentage = 0;
//         $this->discount_amount = 0;
//         $this->payable_amount = 0;
//         $this->paid_amount = 0;
//         $this->payment_status = 'Unpaid';
//         $this->edit_order_id = null;
//         $this->addMedicineRow();
//         $this->resetValidation();
//     }

//     public function cancel()
//     {
//         $this->resetForm();
//         $this->mode = 'list';
//     }

//     public function updatedFiltersPatientName()
//     {
//         $this->resetPage();
//     }

//     public function updatedFiltersPatientNumber()
//     {
//         $this->resetPage();
//     }

//     public function updatedFiltersPaymentStatus()
//     {
//         $this->resetPage();
//     }

//     public function resetFilter()
//     {
//         $this->filters = [
//             'patient_name' => '',
//             'patient_number' => '',
//             'payment_status' => '',
//         ];
//         $this->resetPage();
//     }

//     // render() method আপডেট করুন
//     public function render()
//     {
//         $query = OrderMst::with('patient');

//         // Filter by patient name
//         if (!empty($this->filters['patient_name'])) {
//             $query->whereHas('patient', function ($q) {
//                 $q->where('patient_name', 'like', "%{$this->filters['patient_name']}%");
//             });
//         }

//         // Filter by patient number
//         if (!empty($this->filters['patient_number'])) {
//             $query->whereHas('patient', function ($q) {
//                 $q->where('patient_number', 'like', "%{$this->filters['patient_number']}%");
//             });
//         }

//         // Filter by payment status
//         if (!empty($this->filters['payment_status'])) {
//             $query->where('payment_status', $this->filters['payment_status']);
//         }

//         // Shop filter
//         if (Auth::user()->user_role_id > 1) {
//             $query->where('shop_id', Auth::user()->shop_id);
//         }

//         $orders = $query->orderByDesc('id')->paginate(25);

//         return view('livewire.checkout-module', [
//             'orders' => $orders,
//         ]);
//     }


// }


class CheckoutModule extends Component
{
    use WithPagination;

    public $mode = 'list';
    protected $paginationTheme = 'bootstrap';

    // Patient Fields
    public $patient_id;
    public $patient_name = '';
    public $patient_number = '';
    public $patient_city = '';
    public $patient_state = 'West Bengal';
    public $patientSuggestions = [];
    public $showPatientSuggestions = false;

    // Medicine Fields
    public $medicineRows = [];
    public $medicineSuggestions = [];
    public $showMedicineSuggestions = [];

    // Billing Fields
    public $total_bill_amount = 0;
    public $discount_percentage = 0;
    public $discount_amount = 0;
    public $payable_amount = 0;
    public $paid_amount = 0;
    public $payment_status = 'Unpaid';

    // Edit Mode
    public $edit_order_id;

    // Filters
    public $filters = [
        'patient_name' => '',
        'patient_number' => '',
        'payment_status' => '',
    ];

    protected $rules = [
        'patient_name' => 'required|string|max:255',
        'patient_number' => 'required|string|max:255',
        'medicineRows.*.medicine_id' => 'required|exists:mediciane_msts,id',
        'medicineRows.*.qty' => 'required|integer|min:1',
        'medicineRows.*.price' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        $this->addMedicineRow();
    }

    // Lifecycle hooks for filters
    public function updatedFiltersPatientName()
    {
        $this->resetPage();
    }

    public function updatedFiltersPatientNumber()
    {
        $this->resetPage();
    }

    public function updatedFiltersPaymentStatus()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->filters = [
            'patient_name' => '',
            'patient_number' => '',
            'payment_status' => '',
        ];
        $this->resetPage();
    }

    // Patient Search
    public function updatedPatientName($value)
    {
        if (strlen($value) >= 2) {
            $this->patientSuggestions = PatientMst::where('patient_name', 'like', "%{$value}%")
                ->orWhere('patient_number', 'like', "%{$value}%")
                ->limit(10)
                ->get();
            $this->showPatientSuggestions = true;
        } else {
            $this->showPatientSuggestions = false;
        }
    }

    public function selectPatient($patientId)
    {
        $patient = PatientMst::find($patientId);
        if ($patient) {
            $this->patient_id = $patient->id;
            $this->patient_name = $patient->patient_name;
            $this->patient_number = $patient->patient_number;
            $this->patient_city = $patient->city;
            $this->patient_state = $patient->state;
            $this->showPatientSuggestions = false;
        }
    }

    // Medicine Search with Stock Validation
    public function searchMedicineByIndex($index, $value)
    {
        $this->medicineRows[$index]['medicine_name'] = $value;

        if (strlen($value) >= 2) {
            $this->medicineSuggestions[$index] = MedicianeMst::where('name', 'like', "%{$value}%")
                ->orWhere('generic_name', 'like', "%{$value}%")
                ->where('total_stock', '>', 0)
                ->limit(10)
                ->get();
            $this->showMedicineSuggestions[$index] = true;
        } else {
            $this->showMedicineSuggestions[$index] = false;
            $this->medicineSuggestions[$index] = [];
        }
    }

    public function selectMedicine($index, $medicineId)
    {
        $medicine = MedicianeMst::find($medicineId);
        if ($medicine) {
            $this->medicineRows[$index]['medicine_id'] = $medicine->id;
            $this->medicineRows[$index]['medicine_name'] = $medicine->name;
            $this->medicineRows[$index]['price'] = $medicine->per_stock_mrp;
            $this->medicineRows[$index]['qty'] = 1;
            $this->medicineRows[$index]['available_stock'] = $medicine->total_stock;
            $this->calculateRowTotal($index);
            $this->showMedicineSuggestions[$index] = false;
        }
    }

    // Medicine Row Management
    public function addMedicineRow()
    {
        $index = count($this->medicineRows);
        $this->medicineRows[] = [
            'medicine_id' => null,
            'medicine_name' => '',
            'price' => 0,
            'qty' => 1,
            'grand_total' => 0,
            'available_stock' => 0,
        ];
        $this->showMedicineSuggestions[$index] = false;
    }

    public function removeMedicineRow($index)
    {
        unset($this->medicineRows[$index]);
        $this->medicineRows = array_values($this->medicineRows);
        $this->calculateTotals();
    }

    // Real-time QTY Validation with Stock Check
    public function updatedMedicineRows($value, $key)
    {
        $parts = explode('.', $key);
        if (count($parts) == 2 && $parts[1] == 'qty') {
            $index = $parts[0];

            // Stock Validation
            if (isset($this->medicineRows[$index]['medicine_id']) && $this->medicineRows[$index]['medicine_id']) {
                $medicine = MedicianeMst::find($this->medicineRows[$index]['medicine_id']);

                if ($medicine && $this->medicineRows[$index]['qty'] > $medicine->total_stock) {
                    $this->addError(
                        "medicineRows.{$index}.qty",
                        "Only {$medicine->total_stock} units available in stock!"
                    );
                    $this->medicineRows[$index]['qty'] = $medicine->total_stock;
                } else {
                    $this->resetErrorBag("medicineRows.{$index}.qty");
                }
            }

            $this->calculateRowTotal($index);
        }
    }

    private function calculateRowTotal($index)
    {
        if (isset($this->medicineRows[$index])) {
            $qty = $this->medicineRows[$index]['qty'] ?? 0;
            $price = $this->medicineRows[$index]['price'] ?? 0;
            $this->medicineRows[$index]['grand_total'] = $qty * $price;
            $this->calculateTotals();
        }
    }

    // Calculate Discount
    public function updatedDiscountPercentage($value)
    {
        $this->calculateTotals();
    }

    private function calculateTotals()
    {
        $this->total_bill_amount = collect($this->medicineRows)->sum('grand_total');
        $this->discount_amount = ($this->total_bill_amount * $this->discount_percentage) / 100;
        $this->payable_amount = $this->total_bill_amount - $this->discount_amount;
    }

    // Create New Billing
    public function create()
    {
        $this->resetForm();
        $this->mode = 'create';
    }

    // Checkout Process with Stock Update
    public function checkout()
    {
        // Final Stock Validation before checkout
        foreach ($this->medicineRows as $index => $row) {
            if (!empty($row['medicine_id'])) {
                $medicine = MedicianeMst::find($row['medicine_id']);
                if (!$medicine) {
                    session()->flash('error', 'Medicine not found!');
                    return;
                }
                if ($row['qty'] > $medicine->total_stock) {
                    $this->addError(
                        "medicineRows.{$index}.qty",
                        "{$medicine->name}: Only {$medicine->total_stock} units available!"
                    );
                    return;
                }
            }
        }

        $this->validate();

        try {
            DB::beginTransaction();

            // Save or Update Patient
            if ($this->patient_id) {
                $patient = PatientMst::find($this->patient_id);
                $patient->update([
                    'patient_name' => $this->patient_name,
                    'patient_number' => $this->patient_number,
                    'city' => $this->patient_city,
                    'state' => $this->patient_state,
                    'shop_id' => Auth::user()->id,
                ]);
            } else {
                $patient = PatientMst::create([
                    'patient_name' => $this->patient_name,
                    'patient_number' => $this->patient_number,
                    'city' => $this->patient_city,
                    'state' => $this->patient_state,
                    'shop_id' => Auth::user()->id,
                ]);
                $this->patient_id = $patient->id;
            }

            // Generate Invoice Number
            $invoiceNo = 'INV-' . date('Ymd') . '-' . str_pad(OrderMst::count() + 1, 4, '0', STR_PAD_LEFT);

            // Create Order
            $order = OrderMst::create([
                'patient_id' => $this->patient_id,
                'invoice_no' => $invoiceNo,
                'total_bill_amount' => $this->total_bill_amount,
                'discount_percentage' => $this->discount_percentage,
                'discount_amount' => $this->discount_amount,
                'payable_amount' => $this->payable_amount,
                'paid_amount' => $this->paid_amount,
                'payment_status' => $this->payment_status,
                'shop_id' => Auth::user()->shop_id,
            ]);

            // Create Order Details and Update Stock
            foreach ($this->medicineRows as $row) {
                if (!empty($row['medicine_id'])) {
                    OrderDetail::create([
                        'patient_id' => $this->patient_id,
                        'order_id' => $order->id,
                        'medicine_id' => $row['medicine_id'],
                        'qty' => $row['qty'],
                        'price' => $row['price'],
                        'total_amount' => $row['grand_total'],
                    ]);

                    // Update Medicine Stock, Total Stock and Total File
                    $medicine = MedicianeMst::find($row['medicine_id']);

                    // Update total_stock
                    $newTotalStock = $medicine->total_stock - $row['qty'];

                    // Calculate new total_file using ceil() for rounding up
                    $newTotalFile = 0;
                    if ($medicine->qty_per_file > 0) {
                        $newTotalFile = ceil($newTotalStock / $medicine->qty_per_file);
                    }

                    $medicine->update([
                        'total_stock' => $newTotalStock,
                        'total_file' => $newTotalFile,
                    ]);
                }
            }

            DB::commit();
            session()->flash('success', 'Order created successfully! Invoice: ' . $invoiceNo);
            $this->resetForm();
            $this->mode = 'list';
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // Edit Order
    public function edit($orderId)
    {
        $order = OrderMst::with('orderDetails.medicine', 'patient')->findOrFail($orderId);

        $this->edit_order_id = $order->id;
        $this->patient_id = $order->patient_id;
        $this->patient_name = $order->patient->patient_name;
        $this->patient_number = $order->patient->patient_number;
        $this->patient_city = $order->patient->city;
        $this->patient_state = $order->patient->state;

        $this->medicineRows = [];
        foreach ($order->orderDetails as $detail) {
            $this->medicineRows[] = [
                'medicine_id' => $detail->medicine_id,
                'medicine_name' => $detail->medicine->name,
                'price' => $detail->price,
                'qty' => $detail->qty,
                'grand_total' => $detail->total_amount,
                'available_stock' => $detail->medicine->total_stock + $detail->qty, // Add back the ordered qty
            ];
        }

        $this->discount_percentage = $order->discount_percentage;
        $this->paid_amount = $order->paid_amount;
        $this->payment_status = $order->payment_status;
        $this->calculateTotals();

        $this->mode = 'edit';
    }

    // Update Order with Stock Management
    public function update()
    {
        // Stock validation
        foreach ($this->medicineRows as $index => $row) {
            if (!empty($row['medicine_id'])) {
                $medicine = MedicianeMst::find($row['medicine_id']);
                $oldQty = OrderDetail::where('order_id', $this->edit_order_id)
                    ->where('medicine_id', $row['medicine_id'])
                    ->first()->qty ?? 0;

                $availableStock = $medicine->total_stock + $oldQty;

                if ($row['qty'] > $availableStock) {
                    $this->addError(
                        "medicineRows.{$index}.qty",
                        "{$medicine->name}: Only {$availableStock} units available!"
                    );
                    return;
                }
            }
        }

        $this->validate();

        try {
            DB::beginTransaction();

            $order = OrderMst::findOrFail($this->edit_order_id);

            // Update Patient
            $patient = PatientMst::find($this->patient_id);
            $patient->update([
                'patient_name' => $this->patient_name,
                'patient_number' => $this->patient_number,
                'city' => $this->patient_city,
                'state' => $this->patient_state,
            ]);

            // Update Order
            $order->update([
                'total_bill_amount' => $this->total_bill_amount,
                'discount_percentage' => $this->discount_percentage,
                'discount_amount' => $this->discount_amount,
                'payable_amount' => $this->payable_amount,
                'paid_amount' => $this->paid_amount,
                'payment_status' => $this->payment_status,
            ]);

            // Restore stock from old details
            foreach ($order->orderDetails as $detail) {
                $medicine = MedicianeMst::find($detail->medicine_id);
                $newStock = $medicine->total_stock + $detail->qty;
                $newTotalFile = ($medicine->qty_per_file > 0)
                    ? ceil($newStock / $medicine->qty_per_file)
                    : 0;

                $medicine->update([
                    'total_stock' => $newStock,
                    'total_file' => $newTotalFile,
                ]);
            }
            $order->orderDetails()->delete();

            // Create new order details
            foreach ($this->medicineRows as $row) {
                if (!empty($row['medicine_id'])) {
                    OrderDetail::create([
                        'patient_id' => $this->patient_id,
                        'order_id' => $order->id,
                        'medicine_id' => $row['medicine_id'],
                        'qty' => $row['qty'],
                        'price' => $row['price'],
                        'total_amount' => $row['grand_total'],
                    ]);

                    // Update stock
                    $medicine = MedicianeMst::find($row['medicine_id']);
                    $newStock = $medicine->total_stock - $row['qty'];
                    $newTotalFile = ($medicine->qty_per_file > 0)
                        ? ceil($newStock / $medicine->qty_per_file)
                        : 0;

                    $medicine->update([
                        'total_stock' => $newStock,
                        'total_file' => $newTotalFile,
                    ]);
                }
            }

            DB::commit();
            session()->flash('success', 'Order updated successfully!');
            $this->resetForm();
            $this->mode = 'list';
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // Delete Order with Stock Restore
    public function delete($orderId)
    {
        try {
            DB::beginTransaction();

            $order = OrderMst::with('orderDetails')->findOrFail($orderId);

            // Restore stock
            foreach ($order->orderDetails as $detail) {
                $medicine = MedicianeMst::find($detail->medicine_id);
                $newStock = $medicine->total_stock + $detail->qty;
                $newTotalFile = ($medicine->qty_per_file > 0)
                    ? ceil($newStock / $medicine->qty_per_file)
                    : 0;

                $medicine->update([
                    'total_stock' => $newStock,
                    'total_file' => $newTotalFile,
                ]);
            }

            $order->delete();

            DB::commit();
            session()->flash('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong!');
        }
    }

    // Reset Form
    public function resetForm()
    {
        $this->patient_id = null;
        $this->patient_name = '';
        $this->patient_number = '';
        $this->patient_city = '';
        $this->patient_state = 'West Bengal';
        $this->medicineRows = [];
        $this->total_bill_amount = 0;
        $this->discount_percentage = 0;
        $this->discount_amount = 0;
        $this->payable_amount = 0;
        $this->paid_amount = 0;
        $this->payment_status = 'Unpaid';
        $this->edit_order_id = null;
        $this->addMedicineRow();
        $this->resetValidation();
    }

    public function cancel()
    {
        $this->resetForm();
        $this->mode = 'list';
    }

    public function render()
    {
        $query = OrderMst::with('patient');

        // Filter by patient name
        if (!empty($this->filters['patient_name'])) {
            $query->whereHas('patient', function ($q) {
                $q->where('patient_name', 'like', "%{$this->filters['patient_name']}%");
            });
        }

        // Filter by patient number
        if (!empty($this->filters['patient_number'])) {
            $query->whereHas('patient', function ($q) {
                $q->where('patient_number', 'like', "%{$this->filters['patient_number']}%");
            });
        }

        // Filter by payment status
        if (!empty($this->filters['payment_status'])) {
            $query->where('payment_status', $this->filters['payment_status']);
        }

        // Shop filter
        if (Auth::user()->user_role_id > 1) {
            $query->where('shop_id', Auth::user()->shop_id);
        }

        $orders = $query->orderByDesc('id')->paginate(25);

        return view('livewire.checkout-module', [
            'orders' => $orders,
        ]);
    }
}
