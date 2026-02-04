<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function patient_list(){
        return view('admin.patient.patient');
    }
}
