<?php

namespace App\Http\Controllers;

use App\Exports\SamplePractitionerExcel;
use App\Imports\PractitionersImport;
use App\Models\Practioner;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

class PractitionerController extends Controller
{
    public function practitioners_list()
    {
        $practitioners = Practioner::paginate(10);
        return view('admin.practitioners.index', compact('practitioners'));
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

        $import = new PractitionersImport;

        Excel::import($import, $request->file('practitioner_file'));

        $failures = $import->failures();

        return back()->with([
            'success' => 'Practitioners imported successfully!',
            'failures' => $failures
        ]);
    }
}
