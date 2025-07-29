<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use DateTime;

class HistoryController extends Controller
{
    public function show(Patient $patient)
    {
        $oggi = new DateTime();
        $nascita = new DateTime($patient->birthdate);
        $diff = $oggi->diff($nascita);
        $eta = $diff->y;
        // Show the anamnesis for the given patient
        return view('histories.show', [
            'patient' => $patient,
            'eta' => $eta,
        ]);
    }
}
