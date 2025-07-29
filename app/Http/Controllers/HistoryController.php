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
        $familiar_histories = $patient->familiarHistory()->get();
        $remote_histories = $patient->remotePathologicalHistory()->get();
        $next_histories = $patient->nextPathologicalHistory()->get();
        // Show the anamnesis for the given patient
        return view('histories.show', [
            'patient' => $patient,
            'eta' => $eta,
            'familiar_histories' => $familiar_histories,
            'remote_histories' => $remote_histories,
            'next_histories' => $next_histories,
        ]);
    }
}
