<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    // CRUD operations for patients
    public function newPatientForm()
    {
        return view('patients.create'); // Return the view for creating a new patient
    }
}
