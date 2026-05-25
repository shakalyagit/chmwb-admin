<?php

namespace App\Http\Controllers;

use App\Exports\PractitionerExport;
use App\Exports\SamplePractitionerExcel;
use App\Imports\PractitionersImport;
use Maatwebsite\Excel\Validators\ValidationException as ExcelValidationException;
use Illuminate\Validation\ValidationException as IlluminateValidationException;
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
        $practitioners = Practioner::paginate(50);
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
            'qualification'     => 'required|string|max:255',
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
        } catch (ExcelValidationException $e) {
            // Format validation failures into readable row-based messages
            $failures = $e->failures();
            $messages = [];

            foreach ($failures as $failure) {
                $row = $failure->row();
                $attribute = $failure->attribute();
                $errors = $failure->errors();
                $messages[] = 'Row ' . $row . ': ' . implode(', ', $errors);
            }

            return back()->withErrors([
                'practitioner_file' => implode(' | ', $messages),
            ]);
        } catch (IlluminateValidationException $e) {
            // Handle validation exceptions that may contain keys like "103.registration_no"
            $messages = [];

            $errors = $e->validator->errors()->messages();

            foreach ($errors as $key => $msgs) {
                $parts = explode('.', $key, 2);
                if (count($parts) === 2 && is_numeric($parts[0])) {
                    $row = $parts[0];
                    $attribute = $parts[1];
                } else {
                    $row = null;
                    $attribute = $key;
                }

                foreach ($msgs as $m) {
                    if ($row) {
                        $messages[] = 'Row ' . $row . ': ' . $attribute . ' - ' . $m;
                    } else {
                        $messages[] = $m;
                    }
                }
            }

            return back()->withErrors([
                'practitioner_file' => implode(' | ', $messages),
            ]);
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
            'registration_no' => 'required',
            'registration_date' => 'required|date',
            'name'              => 'required|string',
            'fathers_name'      => 'required|string',
            'address'           => 'required|string',
            'qualification'     => 'required',
        ]);

        $practitioner = Practioner::findOrFail(Crypt::decrypt($id));

        $practitioner->update($request->all());

        return redirect()
            ->route('practitioners_list')
            ->with('success', 'Practitioner updated successfully');
    }

    public function practitioner_filter(Request $request)
    {
        $query = Practioner::query();

        if ($request->filled('reg_no')) {
            $query->where('registration_no', 'like', '%' . $request->reg_no . '%');
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('registration_date', [
                $request->from_date,
                $request->to_date
            ]);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('phone')) {
            $query->where('ph_no', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $practitioners = $query->latest()->paginate(50);

        $html = '';

        if ($practitioners->count() > 0) {
            foreach ($practitioners as $practitioner) {

                $statusBadge = $practitioner->status === 'Active'
                    ? '<span class="bg-success-subtle pt-1 pb-1 ps-3 pe-3 rounded rounded-pill border border-success text-success">Active</span>'
                    : '<span class="bg-danger-subtle pt-1 pb-1 ps-3 pe-3 rounded rounded-pill border border-danger text-danger">Inactive</span>';

                $editUrl = route(
                    'edit_practitioner',
                    Crypt::encrypt($practitioner->id)
                );

                $html .= '
                <tr>
                    <td>' . $practitioner->registration_no . '</td>
                    <td>' . date('d-m-Y', strtotime($practitioner->registration_date)) . '</td>
                    <td>' . $practitioner->name . '</td>
                    <td>' . $practitioner->ph_no . '</td>
                    <td>' . $practitioner->qualification . '</td>
                    <td>' . $statusBadge . '</td>
                    <td class="text-center">
                        <a href="' . $editUrl . '" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                </tr>
            ';
            }
        } else {
            $html .= '
            <tr>
                <td colspan="7" class="text-center">No record found</td>
            </tr>
        ';
        }

        return response()->json([
            'html'       => $html,
            'pagination' => (string) $practitioners->links('pagination::bootstrap-5'),
        ]);
    }

    public function export_practitioners(Request $request)
    {
        $date = date('d_m_Y');
        return Excel::download(
            new PractitionerExport($request),
            'practitioners_list_' . $date . '.xlsx'
        );
    }
}
