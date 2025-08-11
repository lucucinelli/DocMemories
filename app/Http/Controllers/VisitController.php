<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Exports\VisitsExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        return redirect()->route('showVisit', $visit->id)->with('status', __('visit-updated'));
    }

    public function showVisits($patient_id = 0)
    {
        // Logic to list all visits
        $visits = DB::table('visits')
                        ->select('visits.*', 'patients.name', 'patients.surname')
                        ->join('patients', 'visits.patient_id', '=', 'patients.id')
                        ->where('user_id', '=', Auth::id())
                        ->orderBy('visit_date', 'desc')
                        ->paginate(10);
        if ($patient_id != 0) {
            $visits = DB::table('visits')
                        ->select('visits.*', 'patients.name', 'patients.surname')
                        ->join('patients', 'visits.patient_id', '=', 'patients.id')
                        ->where('user_id', '=', Auth::id())
                        ->where('visits.patient_id', '=', $patient_id)
                        ->orderBy('visit_date', 'desc')
                        ->paginate(10);
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
            $visits = DB::table('visits')
                        ->select('visits.*', 'patients.name', 'patients.surname')
                        ->join('patients', 'visits.patient_id', '=', 'patients.id')
                        ->where('user_id', '=', Auth::id())
                        ->where(function ($query) use ($searchTerm) {
                            $query->where('reason', 'LIKE', "%{$searchTerm}%")
                                ->orWhere('diagnosis', 'LIKE', "%{$searchTerm}%")
                                ->orWhere('reservation', 'LIKE', "%{$searchTerm}%")
                                ->orWhereRaw("CONCAT(name, ' ', surname) LIKE ?", ["%{$searchTerm}%"])
                                ->orWhereRaw("CONCAT(surname, ' ', name) LIKE ?", ["%{$searchTerm}%"])
                                ->orWhereRaw("CONCAT(surname, name) LIKE ?", ["%{$searchTerm}%"])
                                ->orWhereRaw("CONCAT(name, surname) LIKE ?", ["%{$searchTerm}%"]);
                        })->orderBy('visit_date','desc')->paginate(10)->appends(['search' => $searchTerm]); // Search for visits by reason, diagnosis, reservation, or patient name
        }
        return view('visits.find', ['visits' => $visits]);
    }
    public function exportVisits(){
        return Excel::download(new VisitsExport(), 'visits.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="visits.csv"',
            'Content-Transfer-Encoding' => 'binary',
            'charset' => 'UTF-8',
            'Content-Encoding' => 'UTF-8',
        ]);
    }

    public function dailyReportVisits(){
        $daily_visits = DB::table('visits')
            ->select('visits.*', 'patients.*')
            ->join('patients', 'visits.patient_id', '=', 'patients.id')
            ->where('user_id', '=', Auth::id())
            ->where('visit_date', '=', now()->format('Y-m-d'))
            ->paginate(10);
        return view('visits.find', ['visits' => $daily_visits]);
    }

    public function weeklyReportVisits(){
        $first_day_of_week = now()->subDays(7)->format('Y-m-d');
        $weekly_visits = DB::table('visits')
            ->select('visits.*', 'patients.*')
            ->join('patients', 'visits.patient_id', '=', 'patients.id')
            ->where('user_id', '=', Auth::id())
            ->where('visit_date', '>=', $first_day_of_week)
            ->where('visit_date', '<=', now()->format('Y-m-d'))
            ->paginate(10);

        return view('visits.find', ['visits' => $weekly_visits]);
    }

    public function monthlyReportVisits(){
        $monthly_visits = DB::table('visits')
            ->select('visits.*', 'patients.*')
            ->join('patients', 'visits.patient_id', '=', 'patients.id')
            ->where('user_id', '=', Auth::id())
            ->where('visit_date', '>=', now()->firstOfMonth()->format('Y-m-d'))
            ->where('visit_date', '<=', now()->lastOfMonth()->format('Y-m-d'))
            ->paginate(10);
        return view('visits.find', ['visits' => $monthly_visits]);
    }

    public function annualReportVisits(){
        $annual_visits = DB::table('visits')
            ->select('visits.*', 'patients.*')
            ->join('patients', 'visits.patient_id', '=', 'patients.id')
            ->where('user_id', '=', Auth::id())
            ->where('visit_date', '>=', now()->firstOfYear()->format('Y-m-d'))
            ->where('visit_date', '<=', now()->lastOfYear()->format('Y-m-d'))
            ->paginate(10);
        return view('visits.find', ['visits' => $annual_visits]);
    }

    // reservations 
    public function dailyReportReservations($type){
        if ($type == 'institutionals') {
            $daily_reservations = DB::table('visits')
                ->select('visits.*', 'patients.*')
                ->join('patients', 'visits.patient_id', '=', 'patients.id')
                ->where('user_id', '=', Auth::id())
                ->where('reservation', '=', 'Istituzionale')
                ->where('visit_date', '=', now()->format('Y-m-d'))
                ->paginate(10);
            return view('visits.find', ['visits' => $daily_reservations]);
        } else {
            $daily_reservations = DB::table('visits')
                ->select('visits.*', 'patients.*')
                ->join('patients', 'visits.patient_id', '=', 'patients.id')
                ->where('user_id', '=', Auth::id())
                ->where('reservation', '=', 'Intramoenia')
                ->where('visit_date', '=', now()->format('Y-m-d'))
                ->paginate(10);
            return view('visits.find', ['visits' => $daily_reservations]);
        }
    }

    public function weeklyReportReservations($type){
        $first_day_of_week = now()->subDays(7)->format('Y-m-d');
        if ($type == 'institutionals') {
            $weekly_reservations = DB::table('visits')
                ->select('visits.*', 'patients.*')
                ->join('patients', 'visits.patient_id', '=', 'patients.id')
                ->where('user_id', '=', Auth::id())
                ->where('reservation', '=', 'Istituzionale')
                ->where('visit_date', '>=', $first_day_of_week)
                ->where('visit_date', '<=', now()->format('Y-m-d'))
                ->paginate(10);
            return view('visits.find', ['visits' => $weekly_reservations]);
        } else {
            $weekly_reservations = DB::table('visits')
                ->select('visits.*', 'patients.*')
                ->join('patients', 'visits.patient_id', '=', 'patients.id')
                ->where('user_id', '=', Auth::id())
                ->where('reservation', '=', 'Intramoenia')
                ->where('visit_date', '>=', $first_day_of_week)
                ->where('visit_date', '<=', now()->format('Y-m-d'))
                ->paginate(10);
            return view('visits.find', ['visits' => $weekly_reservations]);
        }
    }

    public function monthlyReportReservations($type){
        if ($type == 'institutionals') {
            $monthly_reservations = DB::table('visits')
                ->select('visits.*', 'patients.*')
                ->join('patients', 'visits.patient_id', '=', 'patients.id')
                ->where('user_id', '=', Auth::id())
                ->where('reservation', '=', 'Istituzionale')
                ->where('visit_date', '>=', now()->firstOfMonth()->format('Y-m-d'))
                ->where('visit_date', '<=', now()->lastOfMonth()->format('Y-m-d'))
                ->paginate(10);
            return view('visits.find', ['visits' => $monthly_reservations]);
        } else {
            $monthly_reservations = DB::table('visits')
                ->select('visits.*', 'patients.*')
                ->join('patients', 'visits.patient_id', '=', 'patients.id')
                ->where('user_id', '=', Auth::id())
                ->where('reservation', '=', 'Intramoenia')
                ->where('visit_date', '>=', now()->firstOfMonth()->format('Y-m-d'))
                ->where('visit_date', '<=', now()->lastOfMonth()->format('Y-m-d'))
                ->paginate(10);
            return view('visits.find', ['visits' => $monthly_reservations]);
        }
    }

    public function annualReportReservations($type){
        if ($type == 'institutionals') {
            $annual_reservations = DB::table('visits')
                ->select('visits.*', 'patients.*')
                ->join('patients', 'visits.patient_id', '=', 'patients.id')
                ->where('user_id', '=', Auth::id())
                ->where('reservation', '=', 'Istituzionale')
                ->where('visit_date', '>=', now()->firstOfYear()->format('Y-m-d'))
                ->where('visit_date', '<=', now()->lastOfYear()->format('Y-m-d'))
                ->paginate(10);
            return view('visits.find', ['visits' => $annual_reservations]);
        } else {
            $annual_reservations = DB::table('visits')
                ->select('visits.*', 'patients.*')
                ->join('patients', 'visits.patient_id', '=', 'patients.id')
                ->where('user_id', '=', Auth::id())
                ->where('reservation', '=', 'Intramoenia')
                ->where('visit_date', '>=', now()->firstOfYear()->format('Y-m-d'))
                ->where('visit_date', '<=', now()->lastOfYear()->format('Y-m-d'))
                ->paginate(10);
            return view('visits.find', ['visits' => $annual_reservations]);
        }
    }

}
