<?php

namespace App\Http\Controllers;

use App\Models\ApplicationHead;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ApplicationDataController extends Controller
{
    public function application_data(){
        return view('admin.applications.application_data');
    }

    public function showFormDetails($id=null){
        $app = ApplicationHead::with(['details', 'reasons', 'media'])->findOrFail($id);


        $app->detail = $app->details ?? (object)[
            'name' => 'N/A', 'father_name' => 'N/A', 'dob' => null,
            'blood_group' => 'N/A', 'address' => 'N/A', 'district' => 'N/A',
            'pincode' => 'N/A', 'police_station' => 'N/A', 'mobile' => 'N/A',
            'email' => 'N/A', 'aadhaar' => 'N/A', 'reg_number' => null,
            'reg_date' => null, 'qualification' => null, 'examination' => null,
            'held_in' => null, 'university' => 'N/A', 'college' => 'N/A',
            'college_district' => null, 'final_roll_no' => null,
            'term' => null, 'university_reg_no' => null
        ];
        $pdf = Pdf::loadView('admin.pdf.application-form', compact('app'))
                  ->setPaper('a4', 'portrait')
                  ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);


        return $pdf->stream('application-form-' . $id . '.pdf');
    }
}
