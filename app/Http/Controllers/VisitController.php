<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
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

    public function showVisits()
    {
        // Logic to list all visits
        $visits = Auth::user()->visits; // Assuming you have a Visit model
        return view('visits.find', ['visits' => $visits]);
    }

    public function showVisit($visitId)
    {
        // Logic to show a specific visit
        $visit = Visit::findOrFail($visitId);
        return view('visits.show', ['visit' => $visit]);
    }

    public function deleteVisit($visitId)
    {
        // Logic to delete a specific visit
        $visit = Visit::findOrFail($visitId);
        $visit->delete();
        return redirect()->route('showVisits')->with('success', 'Visit deleted successfully.');
    }
}
