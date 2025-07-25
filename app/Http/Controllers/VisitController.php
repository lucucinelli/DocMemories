<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VisitController extends Controller
{

    public function newVisitForm(Patient $patient)
    {
        return view('visits.create', ['patient' => $patient]);
    }

    public function newVisit(Request $request, Patient $patient)
    {
        $incomingData = $request->validate([
            'visit_date' => [ 'required', 'date'],
            'reason' => [ 'required', 'string', 'max:255'],
            'diagnosis' => [ 'required', 'string', 'max:255'],
            'note' => [ 'nullable', 'string'],
        ]);

        $patientId = $patient->id;
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

    public function searchVisits(Request $request)
    {
        $incomingData = $request->validate([
            'search' => ['string', 'nullable', 'max:255'],
        ]);
        $searchTerm = $incomingData['search'];
        if ($searchTerm === null || $searchTerm === '') {
            return redirect()->route('showVisits'); // If search term is empty, redirect to show all visits
        } else {
            $searchTerm = trim($searchTerm); // Trim whitespace from the search term
            $patients = Patient::whereRaw("CONCAT(name, ' ', surname) LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("CONCAT(surname, ' ', name) LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("CONCAT(surname, name) LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("CONCAT(name, surname) LIKE ?", ["%{$searchTerm}%"])
            ->get();
            $visits = Visit::whereIn('patient_id', $patients->pluck('id'))->get();

        }
        return view('visits.find', ['visits' => $visits]);
    }
}
