<?php

namespace App\Livewire;

use App\Models\PatientMst;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

// class PatientModule extends Component
// {
//     public $filtered = [];
//     public $mode = 'list';

//     public function applyFilter(){
//         $this->filtered = $this->filters;
//         $this->resetPage();
//     }

//     public function create(){
//         $this->mode = 'create';
//     }

//     public function render(){
//         $query = PatientMst::query();

//         if (!empty($this->filtered)) {
//             foreach ($this->filters as $col => $val) {
//                 if (!empty($val)) {
//                     if ($col == 'name'  || $col == 'city') {
//                         $query->where($col, 'like', "%$val%");
//                     } elseif ($col == 'patient_name') {
//                         $query->where($col, $val);
//                     } else {
//                         $query->where($col, $val);
//                     }
//                 }
//             }
//         }
//         if (Auth::user()->user_role_id > 1) {
//             $query->where('shop_id', Auth::user()->shop_id);
//         }
//         $patients = $query->orderByDesc('id')->paginate(25);

//         return view('livewire.patient-module', [
//             'patients' => $patients,
//         ]);
//     }
// }

class PatientModule extends Component
{
    use WithPagination;

    public $filtered = [];
    public $filters = [];
    public $mode = 'list';

    // Form Properties
    public $patient_id;
    public $patient_name;
    public $patient_number;
    public $city;
    public $shop_id;
    public $state = 'West Bengal';

    protected $rules = [
        'patient_name' => 'required|string|max:255',
        'patient_number' => 'required|string|max:255',
        'city' => 'nullable|string|max:255',
        'state' => 'required|string|max:255',
    ];

    public function applyFilter()
    {
        $this->filtered = $this->filters;
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->filters = [];
        $this->filtered = [];
        $this->resetPage();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->mode = 'create';
    }

    public function store()
    {
        $this->validate();

        try {
            PatientMst::create([
                'shop_id' => $this->shop_id,
                'patient_name' => $this->patient_name,
                'patient_number' => $this->patient_number,
                'city' => $this->city,
                'state' => $this->state,
            ]);

            session()->flash('success', 'Patient created successfully!');
            $this->resetInputFields();
            $this->mode = 'list';
        } catch (Exception $e) {
            session()->flash('error', 'Something went wrong!'. $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $patient = PatientMst::findOrFail($id);
            $this->patient_id = $patient->id;
            $this->patient_name = $patient->patient_name;
            $this->patient_number = $patient->patient_number;
            $this->city = $patient->city;
            $this->state = $patient->state;
            $this->mode = 'edit';
        } catch (Exception $e) {
            session()->flash('error', 'Patient not found!');
        }
    }

    public function update()
    {
        $this->validate();

        try {
            $patient = PatientMst::findOrFail($this->patient_id);
            $patient->update([
                'patient_name' => $this->patient_name,
                'patient_number' => $this->patient_number,
                'city' => $this->city,
                'state' => $this->state,
            ]);

            session()->flash('success', 'Patient updated successfully!');
            $this->resetInputFields();
            $this->mode = 'list';
        } catch (Exception $e) {
            session()->flash('error', 'Something went wrong!');
        }
    }

    public function delete($id)
    {
        try {
            PatientMst::findOrFail($id)->delete();
            session()->flash('success', 'Patient deleted successfully!');
        } catch (Exception $e) {
            session()->flash('error', 'Something went wrong!');
        }
    }

    public function cancel()
    {
        $this->resetInputFields();
        $this->mode = 'list';
    }

    private function resetInputFields()
    {
        $this->patient_id = null;
        $this->patient_name = '';
        $this->patient_number = '';
        $this->shop_id = Auth::user()->id;
        $this->city = '';
        $this->state = 'West Bengal';
    }

    public function render()
    {
        $query = PatientMst::query();

        if (!empty($this->filtered)) {
            foreach ($this->filtered as $col => $val) {
                if (!empty($val)) {
                    if ($col == 'patient_name' || $col == 'city') {
                        $query->where($col, 'like', "%$val%");
                    } else {
                        $query->where($col, $val);
                    }
                }
            }
        }

        if (Auth::user()->user_role_id > 1) {
            $query->where('shop_id', Auth::user()->shop_id);
        }

        $patients = $query->orderByDesc('id')->paginate(25);

        return view('livewire.patient-module', [
            'patients' => $patients,
        ]);
    }
}
