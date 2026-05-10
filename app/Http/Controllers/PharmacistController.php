<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Pharmacists;
use App\Models\PharmacyRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SamplePharmacistExcel;
use App\Imports\PharmacistsImport;
use Exception;

class PharmacistController extends Controller
{
    public function pharmacist_list()
    {
        $pharmacists = Pharmacists::leftjoin('pharmacy_registrations', 'pharmacy_registrations.pharmacist_id', '=', 'pharmacists.id')
            ->select('pharmacists.*', 'pharmacy_registrations.qualification_name', 'pharmacy_registrations.registration_number', 'pharmacy_registrations.date_of_registration')
            ->paginate(50);
        return view('admin.pharmacist.index', compact('pharmacists'));
    }
    public function add_pharmacist()
    {
        $states = DB::table('states')->orderBy('name')->get();
        return view('admin.pharmacist.add', compact('states'));
    }

    public function add_pharmacist_action(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'father_name' => 'required|string|max:150',
            'aadhaar_number' => 'nullable|string|size:12',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'mobile_number' => 'nullable|string|max:15',
            'email_id' => 'nullable|email|max:150',
            'registration_number' => 'required|string|unique:pharmacy_registrations,registration_number',
            'registration_date' => 'required|date',
            'valid_upto' => 'nullable|date',
            'qualification_name' => 'required|string|max:100',
            'month_year_of_degree' => 'nullable|string|max:100',
            'college_name' => 'nullable|string|max:100',
            'additional_qualification_name' => 'nullable|string|max:100',
            'additional_month_year_of_degree' => 'nullable|string|max:100',
            'additional_college_name' => 'nullable|string|max:100',
            'present_address_line' => 'required|string|max:1000',
            'present_district' => 'nullable|string|max:255',
            'present_pincode' => 'nullable|string|max:20',
            'present_state' => 'nullable|string|max:255',
            'present_police_station' => 'nullable|string|max:255',
            'permanent_address_line' => 'required|string|max:1000',
            'permanent_district' => 'nullable|string|max:255',
            'permanent_pincode' => 'nullable|string|max:20',
            'permanent_state' => 'nullable|string|max:255',
            'permanent_police_station' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $existingRegistration = PharmacyRegistration::where('registration_number', $request->registration_number)->first();

            if ($existingRegistration) {
                $pharmacist = Pharmacists::find($existingRegistration->id);

                if (! $pharmacist) {
                    $pharmacist = new Pharmacists();
                }

                $presentAddress = Address::find($pharmacist->present_address_id);
                if (! $presentAddress) {
                    $presentAddress = new Address();
                }

                $presentAddress->address_line = $request->present_address_line;
                $presentAddress->district = $request->present_district;
                $presentAddress->pincode = $request->present_pincode;
                $presentAddress->state = $request->present_state;
                $presentAddress->police_station = $request->present_police_station;
                $presentAddress->save();

                $permanentAddress = Address::find($pharmacist->permanent_address_id);
                if (! $permanentAddress) {
                    $permanentAddress = new Address();
                }

                $permanentAddress->address_line = $request->permanent_address_line;
                $permanentAddress->district = $request->permanent_district;
                $permanentAddress->pincode = $request->permanent_pincode;
                $permanentAddress->state = $request->permanent_state;
                $permanentAddress->police_station = $request->permanent_police_station;
                $permanentAddress->save();

                $pharmacist->name = $request->name;
                $pharmacist->father_name = $request->father_name;
                $pharmacist->aadhaar_number = $request->aadhaar_number;
                $pharmacist->date_of_birth = $request->date_of_birth;
                $pharmacist->gender = $request->gender;
                $pharmacist->mobile_number = $request->mobile_number;
                $pharmacist->email_id = $request->email_id;
                $pharmacist->present_address_id = $presentAddress->id;
                $pharmacist->permanent_address_id = $permanentAddress->id;
                $pharmacist->field_1 = $request->field_1;
                $pharmacist->field_2 = $request->field_2;
                $pharmacist->field_3 = $request->field_3;
                $pharmacist->field_4 = $request->field_4;
                $pharmacist->save();

                $existingRegistration->pharmacist_id = $pharmacist->id;
                $existingRegistration->date_of_registration = $request->registration_date;
                $existingRegistration->valid_upto = $request->valid_upto;
                $existingRegistration->qualification_name = $request->qualification_name;
                $existingRegistration->qualification_held = $request->month_year_of_degree;
                $existingRegistration->qualification_college = $request->college_name;
                $existingRegistration->add_qualification_name = $request->additional_qualification_name;
                $existingRegistration->add_qualification_held = $request->additional_month_year_of_degree;
                $existingRegistration->add_qualification_college = $request->additional_college_name;
                $existingRegistration->save();
            } else {
                $presentAddress = new Address();
                $presentAddress->address_line = $request->present_address_line;
                $presentAddress->district = $request->present_district;
                $presentAddress->pincode = $request->present_pincode;
                $presentAddress->state = $request->present_state;
                $presentAddress->police_station = $request->present_police_station;
                $presentAddress->save();

                $permanentAddress = new Address();
                $permanentAddress->address_line = $request->permanent_address_line;
                $permanentAddress->district = $request->permanent_district;
                $permanentAddress->pincode = $request->permanent_pincode;
                $permanentAddress->state = $request->permanent_state;
                $permanentAddress->police_station = $request->permanent_police_station;
                $permanentAddress->save();

                $pharmacist = new Pharmacists();
                $pharmacist->name = $request->name;
                $pharmacist->father_name = $request->father_name;
                $pharmacist->aadhaar_number = $request->aadhaar_number;
                $pharmacist->date_of_birth = $request->date_of_birth;
                $pharmacist->gender = $request->gender;
                $pharmacist->mobile_number = $request->mobile_number;
                $pharmacist->email_id = $request->email_id;
                $pharmacist->present_address_id = $presentAddress->id;
                $pharmacist->permanent_address_id = $permanentAddress->id;
                $pharmacist->field_1 = $request->field_1;
                $pharmacist->field_2 = $request->field_2;
                $pharmacist->field_3 = $request->field_3;
                $pharmacist->field_4 = $request->field_4;
                $pharmacist->save();

                $registration = new PharmacyRegistration();
                $registration->pharmacist_id = $pharmacist->id;
                $registration->registration_number = $request->registration_number;
                $registration->date_of_registration = $request->registration_date;
                $registration->valid_upto = $request->valid_upto;
                $registration->qualification_name = $request->qualification_name;
                $registration->qualification_held = $request->month_year_of_degree;
                $registration->qualification_college = $request->college_name;
                $registration->add_qualification_name = $request->additional_qualification_name;
                $registration->add_qualification_held = $request->additional_month_year_of_degree;
                $registration->add_qualification_college = $request->additional_college_name;
                $registration->save();
            }
        });
        return redirect()->route('pharmacist_list')->with('success', 'Pharmacist saved successfully.');
    }

    public function edit_pharmacist($id)
    {
        $decryptId = Crypt::decrypt($id);
        $pharmacist = Pharmacists::findOrFail($decryptId);
        $registration = PharmacyRegistration::where('pharmacist_id', $pharmacist->id)->first();
        $presentAddress = Address::find($pharmacist->present_address_id);
        $permanentAddress = Address::find($pharmacist->permanent_address_id);
        $states = DB::table('states')->orderBy('name')->get();

        return view('admin.pharmacist.edit', compact(
            'pharmacist',
            'registration',
            'presentAddress',
            'permanentAddress',
            'states'
        ));
    }

    public function update_pharmacist(Request $request, $id)
    {
        $decryptId = Crypt::decrypt($id);
        $pharmacist = Pharmacists::findOrFail($decryptId);
        $registration = PharmacyRegistration::where('pharmacist_id', $pharmacist->id)->first();

        $request->validate([
            'name' => 'required|string|max:150',
            'father_name' => 'required|string|max:150',
            'aadhaar_number' => 'nullable|string|size:12',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'mobile_number' => 'nullable|string|max:15',
            'email_id' => 'nullable|email|max:150',
            'registration_number' => [
                'required',
                'string',
                'max:100',
                Rule::unique('pharmacy_registrations', 'registration_number')->ignore($registration ? $registration->id : null),
            ],
            'registration_date' => 'required|date',
            'valid_upto' => 'nullable|date',
            'qualification_name' => 'required|string|max:100',
            'month_year_of_degree' => 'nullable|string|max:100',
            'college_name' => 'nullable|string|max:100',
            'additional_qualification_name' => 'nullable|string|max:100',
            'additional_month_year_of_degree' => 'nullable|string|max:100',
            'additional_college_name' => 'nullable|string|max:100',
            'present_address_line' => 'required|string|max:1000',
            'present_district' => 'nullable|string|max:255',
            'present_pincode' => 'nullable|string|max:20',
            'present_state' => 'nullable|string|max:255',
            'present_police_station' => 'nullable|string|max:255',
            'permanent_address_line' => 'required|string|max:1000',
            'permanent_district' => 'nullable|string|max:255',
            'permanent_pincode' => 'nullable|string|max:20',
            'permanent_state' => 'nullable|string|max:255',
            'permanent_police_station' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $pharmacist, $registration) {
            $presentAddress = Address::find($pharmacist->present_address_id);
            if (! $presentAddress) {
                $presentAddress = new Address();
            }

            $presentAddress->address_line = $request->present_address_line;
            $presentAddress->district = $request->present_district;
            $presentAddress->pincode = $request->present_pincode;
            $presentAddress->state = $request->present_state;
            $presentAddress->police_station = $request->present_police_station;
            $presentAddress->save();

            $permanentAddress = Address::find($pharmacist->permanent_address_id);
            if (! $permanentAddress) {
                $permanentAddress = new Address();
            }

            $permanentAddress->address_line = $request->permanent_address_line;
            $permanentAddress->district = $request->permanent_district;
            $permanentAddress->pincode = $request->permanent_pincode;
            $permanentAddress->state = $request->permanent_state;
            $permanentAddress->police_station = $request->permanent_police_station;
            $permanentAddress->save();

            $pharmacist->name = $request->name;
            $pharmacist->father_name = $request->father_name;
            $pharmacist->aadhaar_number = $request->aadhaar_number;
            $pharmacist->date_of_birth = $request->date_of_birth;
            $pharmacist->gender = $request->gender;
            $pharmacist->mobile_number = $request->mobile_number;
            $pharmacist->email_id = $request->email_id;
            $pharmacist->present_address_id = $presentAddress->id;
            $pharmacist->permanent_address_id = $permanentAddress->id;
            $pharmacist->status = $request->status;
            $pharmacist->field_1 = $request->field_1;
            $pharmacist->field_2 = $request->field_2;
            $pharmacist->field_3 = $request->field_3;
            $pharmacist->field_4 = $request->field_4;
            $pharmacist->save();

            if (! $registration) {
                $registration = new PharmacyRegistration();
                $registration->pharmacist_id = $pharmacist->id;
            }

            $registration->registration_number = $request->registration_number;
            $registration->date_of_registration = $request->registration_date;
            $registration->valid_upto = $request->valid_upto;
            $registration->qualification_name = $request->qualification_name;
            $registration->qualification_held = $request->month_year_of_degree;
            $registration->qualification_college = $request->college_name;
            $registration->add_qualification_name = $request->additional_qualification_name;
            $registration->add_qualification_held = $request->additional_month_year_of_degree;
            $registration->add_qualification_college = $request->additional_college_name;
            $registration->save();
        });

        return redirect()->route('pharmacist_list')->with('success', 'Pharmacist updated successfully.');
    }

    public function pharmacist_filter(Request $request)
    {
        $query = Pharmacists::leftJoin('pharmacy_registrations', 'pharmacy_registrations.pharmacist_id', '=', 'pharmacists.id')
            ->select('pharmacists.*', 'pharmacy_registrations.registration_number', 'pharmacy_registrations.date_of_registration', 'pharmacy_registrations.qualification_name');

        if ($request->filled('reg_no')) {
            $query->where('pharmacy_registrations.registration_number', 'like', '%' . $request->reg_no . '%');
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('pharmacy_registrations.date_of_registration', [
                $request->from_date,
                $request->to_date,
            ]);
        }

        if ($request->filled('name')) {
            $query->where('pharmacists.name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('phone')) {
            $query->where('pharmacists.mobile_number', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('status')) {
            $query->where('pharmacists.status', $request->status);
        }

        $pharmacists = $query->latest('pharmacists.id')->paginate(50);
        $html = '';

        if ($pharmacists->count() > 0) {
            foreach ($pharmacists as $pharmacist) {
                $statusBadge = $pharmacist->status === 'Active'
                    ? '<span class="bg-success-subtle pt-1 pb-1 ps-3 pe-3 rounded rounded-pill border border-success text-success">Active</span>'
                    : '<span class="bg-danger-subtle pt-1 pb-1 ps-3 pe-3 rounded rounded-pill border border-danger text-danger">Inactive</span>';

                $editUrl = route('edit_pharmacist', Crypt::encrypt($pharmacist->id));

                $html .= '<tr>' .
                    '<td>' . $pharmacist->registration_number . '</td>' .
                    '<td>' . ($pharmacist->date_of_registration ? date('d-m-Y', strtotime($pharmacist->date_of_registration)) : '') . '</td>' .
                    '<td>' . $pharmacist->name . '</td>' .
                    '<td>' . ($pharmacist->mobile_number ?? 'N/A') . '</td>' .
                    '<td>' . ($pharmacist->qualification_name ?? 'N/A') . '</td>' .
                    '<td>' . $statusBadge . '</td>' .
                    '<td class="text-center">' .
                    '<a href="' . $editUrl . '" class="btn btn-outline-danger btn-sm">' .
                    '<i class="bi bi-pencil-square"></i>' .
                    '</a>' .
                    '</td>' .
                    '</tr>';
            }
        } else {
            $html .= '<tr><td colspan="7" class="text-center">No record found</td></tr>';
        }

        return response()->json([
            'html' => $html,
            'pagination' => (string) $pharmacists->links('pagination::bootstrap-5'),
        ]);
    }

    public function export_pharmacists(Request $request)
    {
        $date = date('d_m_Y');
        return Excel::download(
            new \App\Exports\PharmacistExport($request),
            'pharmacists_list_' . $date . '.xlsx'
        );
    }

    public function download_sample_excel()
    {
        return Excel::download(new SamplePharmacistExcel, 'sample_pharmacist.xlsx');
    }

    public function upload_pharmacist_excel(Request $request)
    {
        $request->validate([
            'pharmacist_file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            $import = new PharmacistsImport();
            Excel::import($import, $request->file('pharmacist_file'));

            // Check if there were any row-level validation errors
            $errors = $import->getErrors();

            if (!empty($errors)) {
                return back()
                    //->with('success', "Import complete. {$import->getImportedCount()} row(s) imported successfully.")
                    ->withErrors(['import_errors' => $errors]);
            }

            return back()->with('success', 'Pharmacists imported successfully.');
        } catch (Exception $e) {
            return back()->withErrors([
                'pharmacist_file' => $e->getMessage()
            ]);
        }
    }
}
