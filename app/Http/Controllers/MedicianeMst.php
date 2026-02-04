<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicianeMst extends Controller
{
    public function medicine_list(){
        return view('admin.medicine.index');
    }

}
