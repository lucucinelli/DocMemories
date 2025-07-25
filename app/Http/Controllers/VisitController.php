<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
    public function newVisitForm($patientId)
    {
        $patient = Patient::find($patientId);
        if (!$patient) {
            abort(404, 'Patient not found'); // da modificare con la vista di errore
        }   
        return view('visits.create', ['patient' => $patient]);
    }

    public function newVisit(Request $request, $patientId)
    {
        $incomingData = $request->validate([
            'date' => 'required|date',
            'reason' => 'required|string|max:255',
            'diagnosis' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        $visit = new Visit($incomingData);
        $visit->patient_id = $patientId;
        $visit->user_id = Auth::id();
        $visit->save();

        return redirect()->route('showVisits');
    }

    public function showVisits()
    {
        // Logic to list all visits
        $visits = Auth::user()->visits; // Assuming you have a Visit model
        return view('visits.find', ['visits' => $visits]);
    }
}
