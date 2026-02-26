<?php

namespace App\Http\Controllers;

use App\Exports\SamplePractitionerExcel;
use App\Imports\PractitionersImport;
use App\Models\Practioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

class PractitionerController extends Controller
{
    public function practitioners_list()
    {
        $practitioners = Practioner::paginate(10);
        return view('admin.practitioners.index', compact('practitioners'));
    }

    public function add_practitioner()
    {
        $states = DB::table('states')->orderBy('name')->get();
        return view('admin.practitioners.add', compact('states'));
    }

    public function get_districts($sid)
    {
        $districts = DB::table('districts')->where('sid', $sid)
            ->orderBy('name')
            ->get(['id', 'name']);
        return response()->json($districts);
    }

    public function add_practitioner_action(Request $request)
    {
        $request->validate([
            'registration_no'   => 'required|string|unique:practioners,registration_no',
            'registration_date' => 'required|date',
            'name'              => 'required|string|max:255',
            'fathers_name'      => 'required|string|max:255',
            'address'           => 'required|string',
            'state'             => 'required|string',
            'district'          => 'required|string',
            'pincode'           => 'required|digits_between:5,6',
            'ph_no'             => 'required|digits_between:10,12',
            'email_id'          => 'required|email',
            'qualification'     => 'required|string|max:255',
            'part'              => 'required|string|max:50',
        ]);

        $practitioner = new Practioner();
        $practitioner->registration_no = $request->registration_no;
        $practitioner->registration_date = $request->registration_date;
        $practitioner->name = $request->name;
        $practitioner->fathers_name = $request->fathers_name;
        $practitioner->address = $request->address;
        $practitioner->state = $request->state;
        $practitioner->district = $request->district;
        $practitioner->pincode = $request->pincode;
        $practitioner->ph_no = $request->ph_no;
        $practitioner->email_id = $request->email_id;
        $practitioner->qualification = $request->qualification;
        $practitioner->part = $request->part;
        $practitioner->save();

        return redirect()
            ->route('practitioners_list')
            ->with('success', 'Practitioner added successfully!');
    }

    public function download_sample_excel()
    {
        return Excel::download(new SamplePractitionerExcel, 'sample_practitioner.xlsx');
    }

    public function upload_practitioner_excel(Request $request)
    {
        $request->validate([
            'practitioner_file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new PractitionersImport, $request->file('practitioner_file'));

            return back()->with('success', 'Practitioners imported successfully!');
        } catch (\Exception $e) {
            return back()->withErrors([
                'practitioner_file' => $e->getMessage()
            ]);
        }
    }

    public function edit_practitioner($id)
    {
        $decrypt_id = Crypt::decrypt($id);
        $practitioner = Practioner::findOrFail($decrypt_id);
        $states = DB::table('states')->orderBy('name')->get();

        return view('admin.practitioners.edit', compact('practitioner', 'states'));
    }

    public function update_practitioner(Request $request, $id)
    {
        $request->validate([
            'registration_date' => 'required|date',
            'name'              => 'required|string',
            'fathers_name'      => 'required|string',
            'address'           => 'required|string',
            'state'             => 'required',
            'district'          => 'required',
            'pincode'           => 'required',
            'ph_no'             => 'required',
            'email_id'          => 'required|email',
            'qualification'     => 'required',
            'part'              => 'required',
            'status'            => 'required',
        ]);

        $practitioner = Practioner::findOrFail(Crypt::decrypt($id));

        $practitioner->update($request->all());

        return redirect()
            ->route('practitioners_list')
            ->with('success', 'Practitioner updated successfully');
    }
}
