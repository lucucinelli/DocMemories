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
            'diagnosis' => ['nullable', 'string', 'max:255'],
            'reservation' => [ 'required', 'string', 'max:255'],
            'note' => [ 'nullable', 'string'],
        ]);

        $patientId = $patient->id;
        $visit = new Visit($incomingData);
        $visit->patient_id = $patientId;
        $visit->user_id = Auth::id();
        $visit->save();

        return redirect()->route('showVisit', $visit->id);
    }

    public function editVisit(Request $request, Visit $visit)
    {
        $incomingData = $request->validate([
            'visit_date' => [ 'required', 'date'],
            'reason' => [ 'required', 'string', 'max:255'],
            'diagnosis' => [ 'nullable', 'string', 'max:255'],
            'reservation' => [ 'required', 'string', 'max:255'],
            'note' => [ 'nullable', 'string'],
        ]);

        $visit->update($incomingData);
        return redirect()->route('showVisit', $visit->id)->with('status', __('visit-updated'));;
    }

    public function showVisits($patient_id = 0)
    {
        // Logic to list all visits
        $visits = Auth::user()->visits; // Assuming you have a Visit model
        if ($patient_id != 0) {
            $visits = $visits->where('patient_id', $patient_id);
        }
        return view('visits.find', ['visits' => $visits]);
    }

    public function showVisit($visitId)
    {
        // Logic to show a specific visit
        $visit = Auth::user()->visits->findOrFail($visitId);
        $tests = $visit->allergyTests()->get(); // Assuming you have a relationship defined in the Visit model
        $exams = $visit->exams()->get(); // Assuming you have a relationship defined in the Visit model
        $medicinals = $visit->medicinals()->get(); // Assuming you have a relationship defined in the Visit model
        return view('visits.show', ['visit' => $visit, 'tests' => $tests, 'exams' => $exams, 'medicinals' => $medicinals]);
    }

    public function deleteVisit($visitId)
    {
        // Logic to delete a specific visit
        $visit = Auth::user()->visits->findOrFail($visitId);
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
            $visits = Auth::user()->visits->whereIn('patient_id', $patients->pluck('id'))
            ->orWhere('reason', 'LIKE', "%{$searchTerm}%")
            ->orWhere('diagnosis', 'LIKE', "%{$searchTerm}%")
            ->orWhere('reservation', 'LIKE', "%{$searchTerm}%")
            ->get();
        }
        return view('visits.find', ['visits' => $visits]);
    }
}
