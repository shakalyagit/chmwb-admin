<?php

namespace App\Livewire;

use App\Models\MedicianeMst;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MedicineMaster extends Component
{
    use WithPagination;

    public $mode = 'list';
    public $isEdit = false;
    public $showForm = false;

    public $medicin_id, $name, $generic_name, $hsn_code, $batch_no, $shop_id,
        $expire_date, $total_file, $qty_per_file, $per_file_mrp, $total_stock, $per_stock_mrp, $edit_id;

    public $filters = [
        'medicin_id' => '',
        'name' => '',
        'generic_name' => '',
        'expire_date' => '',
    ];

    protected $rules = [
        'medicin_id' => 'required',
        'name' => 'required|string|max:150',
        'generic_name' => 'nullable|string|max:150',
        'hsn_code' => 'nullable|string|max:50',
        'batch_no' => 'nullable',
        'expire_date' => 'nullable|date',
        'total_file' => 'required|integer',
        'qty_per_file' => 'required|integer',
        'per_file_mrp' => 'required|numeric',
        'total_stock' => 'required|integer',
        'per_stock_mrp' => 'required|numeric',
    ];

    protected $paginationTheme = 'bootstrap';

    public $filtered = [];

    public function updatedFiltersMedicinId()
    {
        $this->resetPage();
    }

    public function updatedFiltersName()
    {
        $this->resetPage();
    }

    public function updatedFiltersGenericName()
    {
        $this->resetPage();
    }

    public function updatedFiltersExpireDate()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->resetForm();
    }

    public function updatedTotalFile($value)
    {
        $this->calculateStock();
    }

    public function updatedQtyPerFile($value)
    {
        $this->calculateStock();
    }

    public function updatedPerFileMrp($value)
    {
        $this->calculateStock();
    }

    private function calculateStock()
    {
        if ($this->qty_per_file > 0) {
            $this->total_stock = $this->total_file * $this->qty_per_file;
            $this->per_stock_mrp = number_format($this->per_file_mrp / $this->qty_per_file, 2, '.', '');
        }
    }

    // public function render()
    // {
    //     $query = MedicianeMst::query();

    //     if (!empty($this->filtered)) {
    //         foreach ($this->filters as $col => $val) {
    //             if (!empty($val)) {
    //                 if ($col == 'name' || $col == 'generic_name') {
    //                     $query->where($col, 'like', "%$val%");
    //                 } elseif ($col == 'expire_date') {
    //                     $query->where($col, $val);
    //                 } else {
    //                     $query->where($col, $val);
    //                 }
    //             }
    //         }
    //     }
    //     if (Auth::user()->user_role_id > 1) {
    //         $query->where('shop_id', Auth::user()->shop_id);
    //     }
    //     $medicines = $query->orderByDesc('id')->paginate(25);

    //     return view('livewire.medicine-master', [
    //         'medicines' => $medicines,
    //     ]);
    // }

    public function render()
    {
        $query = MedicianeMst::query();

        if (!empty($this->filters['medicin_id'])) {
            $query->where('medicin_id', $this->filters['medicin_id']);
        }

        if (!empty($this->filters['name'])) {
            $query->where('name', 'like', "%{$this->filters['name']}%");
        }

        if (!empty($this->filters['generic_name'])) {
            $query->where('generic_name', 'like', "%{$this->filters['generic_name']}%");
        }

        if (!empty($this->filters['expire_date'])) {
            $query->where('expire_date', $this->filters['expire_date']);
        }

        if (Auth::user()->user_role_id > 1) {
            $query->where('shop_id', Auth::user()->shop_id);
        }

        $medicines = $query->orderByDesc('id')->paginate(25);

        return view('livewire.medicine-master', [
            'medicines' => $medicines,
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->mode = 'create';
    }

    public function edit($id)
    {
        $data = MedicianeMst::findOrFail($id);

        $this->edit_id = $data->id;
        $this->medicin_id = $data->medicin_id;
        $this->name = $data->name;
        $this->generic_name = $data->generic_name;
        $this->hsn_code = $data->hsn_code;
        $this->batch_no = $data->batch_no;
        $this->expire_date = $data->expire_date;
        $this->total_file = $data->total_file;
        $this->qty_per_file = $data->qty_per_file;
        $this->per_file_mrp = $data->per_file_mrp;
        $this->total_stock = $data->total_stock;
        $this->per_stock_mrp = $data->per_stock_mrp;
        $this->mode = 'edit';
    }

    // Store new
    public function store()
    {
        $this->validate();
        MedicianeMst::create($this->formArray());

        session()->flash('success', 'Medicine saved successfully!');
        $this->resetForm();
        $this->mode = 'list';
    }

    // Update existing
    public function update()
    {
        $this->validate();
        MedicianeMst::find($this->edit_id)->update($this->formArray());
        session()->flash('success', 'Medicine updated successfully!');
        $this->resetForm();
        $this->mode = 'list';
    }

    public function delete($id)
    {
        MedicianeMst::destroy($id);
        session()->flash('success', 'Record has been deleted!');
        $this->resetForm();
        $this->mode = 'list';
    }

    public function resetForm()
    {
        $this->edit_id = null;
        $this->medicin_id = '';
        $this->name = '';
        $this->generic_name = '';
        $this->hsn_code = '';
        $this->batch_no = '';
        $this->expire_date = '';
        $this->total_file = 0;
        $this->qty_per_file = 0;
        $this->per_file_mrp = 0;
        $this->total_stock = 0;
        $this->per_stock_mrp = 0;
        $this->resetValidation();
        $this->mode = 'list';
    }

    protected function formArray()
    {
        return [
            'shop_id' => Auth::user()->shop_id,
            'medicin_id' => $this->medicin_id,
            'name' => $this->name,
            'generic_name' => $this->generic_name,
            'hsn_code' => $this->hsn_code,
            'batch_no' => $this->batch_no,
            'expire_date' => $this->expire_date,
            'total_file' => $this->total_file,
            'qty_per_file' => $this->qty_per_file,
            'per_file_mrp' => $this->per_file_mrp,
            'total_stock' => $this->total_stock,
            'per_stock_mrp' => $this->per_stock_mrp,
        ];
    }

    public function applyFilter()
    {
        $this->filtered = $this->filters;
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->filters = [
            'medicin_id' => '',
            'name' => '',
            'generic_name' => '',
            'expire_date' => '',
        ];

        $this->filtered = [];
        $this->resetPage();
    }
}
