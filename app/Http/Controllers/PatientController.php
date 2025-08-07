<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Exports\PatientsExport;

use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Container\Attributes\Auth;

class PatientController extends Controller
{
    // CRUD operations for patients
    public function newPatientForm()
    {
        return view('patients.create'); // Return the view for creating a new patient
    }

    public function newPatient(Request $request)
    {
        $incomingData = $request->validate([
            'name' => [ 'required', 'string', 'max:255'],
            'surname' => [ 'required', 'string', 'max:255'],
            'birthdate' => [ 'required', 'date'],
            'gender' => [ 'required', 'string', 'max:1'],
            'birthplace' => [ 'required', 'string', 'max:100'],
            'tax_code' => [ 'required', 'string', 'min:16', 'max:16'],
            'marital_status' => [ 'required', 'string', 'max:50'],
            'nationality' => [ 'required', 'string', 'max:50'],
            'city' => [ 'required', 'string', 'max:100'],
            'province' => [ 'required', 'string', 'min:2', 'max:2'],
            'address' => [ 'required', 'string', 'max:255'],
            'street_number' => [ 'required', 'string', 'max:10'],
            'zip_code' => [ 'required', 'string', 'min:5', 'max:5'],
            'domicile_city' => [ 'nullable', 'string', 'max:100'],
            'domicile_province' => [ 'nullable', 'string', 'min:2', 'max:2'],
            'domicile_address' => [ 'nullable', 'string', 'max:255'],
            'domicile_street_number' => [ 'nullable', 'string', 'max:10'],
            'domicile_zip_code' => [ 'nullable', 'string', 'min:5', 'max:5'],
            'telephone' => [ 'required', 'string', 'max:15'],
            'email' => [ 'required', 'email', 'max:255'],
            'occupation' => [ 'nullable', 'string', 'max:100'],
        ]);

        $patient = Patient::create($incomingData);
        return redirect()->route('showPatient', $patient->id);
    }

    public function showPatients()
    {
        $patients = Patient::orderBy('surname')->paginate(10); // Retrieve all patients from the database
        return view('patients.find', ['patients' => $patients]); // Return the view with the list of patients
    }

    public function showPatient(Patient $patient)
    {
        return view('patients.show', ['patient' => $patient]);
    }

    public function searchPatient(Request $request)
    {
        $incomingData = $request->validate([
            'search' => ['string', 'nullable', 'max:255'],
        ]);
        $searchTerm = $incomingData['search'];
        if ($searchTerm === null || $searchTerm === '') {
            return redirect()->route('showPatients'); // If search term is empty, redirect to show all patients
        } else {
            $searchTerm = trim($searchTerm); // Trim whitespace from the search term
            $patients = Patient::whereRaw("CONCAT(name, ' ', surname) LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("CONCAT(surname, ' ', name) LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("CONCAT(surname, name) LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("CONCAT(name, surname) LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("CONCAT(gender, 'aschio') LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("CONCAT(gender, 'emmina') LIKE ?", ["%{$searchTerm}%"])
            ->paginate(10)
            ->appends(['search' => $searchTerm]); // Search for patients by
        }
        return view('patients.find', ['patients' => $patients]);
    }

    public function editPatient(Patient $patient, Request $request)
    {
        $incomingData = $request->validate([
            'name' => [ 'required', 'string', 'max:255'],
            'surname' => [ 'required', 'string', 'max:255'],
            'birthdate' => [ 'required', 'date'],
            'gender' => [ 'required', 'string', 'max:1'],
            'birthplace' => [ 'required', 'string', 'max:100'],
            'tax_code' => [ 'required', 'string', 'min:16', 'max:16'],
            'marital_status' => [ 'required', 'string', 'max:50'],
            'nationality' => [ 'required', 'string', 'max:50'],
            'city' => [ 'required', 'string', 'max:100'],
            'province' => [ 'required', 'string', 'min:2', 'max:2'],
            'address' => [ 'required', 'string', 'max:255'],
            'street_number' => [ 'required', 'string', 'max:10'],
            'zip_code' => [ 'required', 'string', 'min:5', 'max:5'],
            'domicile_city' => [ 'nullable', 'string', 'max:100'],
            'domicile_province' => [ 'nullable', 'string', 'min:2', 'max:2'],
            'domicile_address' => [ 'nullable', 'string', 'max:255'],
            'domicile_street_number' => [ 'nullable', 'string', 'max:10'],
            'domicile_zip_code' => [ 'nullable', 'string', 'min:5', 'max:5'],
            'telephone' => [ 'required', 'string', 'max:15'],
            'email' => [ 'required', 'email', 'max:255'],
            'occupation' => [ 'nullable', 'string', 'max:100'],
        ]);
        $patient->update($incomingData); // Update the patient with the validated data
        return redirect()->route('showPatient', $patient->id)->with('status', __('patient-updated'));
    }

    public function deletePatient(Patient $patient)
    {
        $patient->delete(); // Delete the patient from the database
        return redirect()->route('showPatients')->with('status', __('patient-deleted'));
    }

    public function exportPatients(){
        return Excel::download(new PatientsExport(), 'patients.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="patients.csv"',
            'Content-Transfer-Encoding' => 'binary',
            'charset' => 'UTF-8',
            'Content-Encoding' => 'UTF-8',
        ]);
    }
}
