<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

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
            'nationality' => [ 'required', 'string', 'max:50'],
            'birthplace' => [ 'required', 'string', 'max:100'],
            'province' => [ 'required', 'string', 'min:2', 'max:2'],
            'address' => [ 'required', 'string', 'max:255'],
            'street_number' => [ 'required', 'string', 'max:10'],
            'zip_code' => [ 'required', 'string', 'min:5', 'max:5'],
            'tax_code' => [ 'required', 'string', 'min:16', 'max:16'],
            'telephone' => [ 'required', 'string', 'max:15'],
            'email' => [ 'required', 'email', 'max:255'],
            'occupation' => [ 'nullable', 'string', 'max:100'],
        ]);

        $patient = Patient::create($incomingData);
        return redirect()->route('showPatient', $patient->id);
    }

    public function showPatients()
    {
        $patients = Patient::all(); // Retrieve all patients from the database
        return view('patients.find', ['patients' => $patients]); // Return the view with the list of patients
    }

    public function showPatient(Patient $patient)
    {
        return view('patients.show', ['patient' => $patient]);
    }

    public function editPatient(Patient $patient, Request $request)
    {
        $incomingData = $request->validate([
            'name' => [ 'required', 'string', 'max:255'],
            'surname' => [ 'required', 'string', 'max:255'],
            'birthdate' => [ 'required', 'date'],
            'gender' => [ 'required', 'string', 'max:1'],
            'nationality' => [ 'required', 'string', 'max:50'],
            'birthplace' => [ 'required', 'string', 'max:100'],
            'province' => [ 'required', 'string', 'min:2', 'max:2'],
            'address' => [ 'required', 'string', 'max:255'],
            'street_number' => [ 'required', 'string', 'max:10'],
            'zip_code' => [ 'required', 'string', 'min:5', 'max:5'],
            'tax_code' => [ 'required', 'string', 'min:16', 'max:16'],
            'telephone' => [ 'required', 'string', 'max:15'],
            'email' => [ 'required', 'email', 'max:255'],
            'occupation' => [ 'nullable', 'string', 'max:100'],
        ]);
        $patient->update($incomingData); // Update the patient with the validated data
        return redirect()->route('showPatient', $patient->id)->with('status', __('patient-updated'));
    }
}
