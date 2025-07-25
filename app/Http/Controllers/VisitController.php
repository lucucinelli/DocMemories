<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
    public function newVisitForm($patientId = 0)
    {
        // Logic to show the form for creating a new visit for the patient
        $patients = Patient::all(); // Fetch all patients to show in the form if needed
        return view('visits.create', ['patientId' => $patientId, 'patients' => $patients]);
    }
}
