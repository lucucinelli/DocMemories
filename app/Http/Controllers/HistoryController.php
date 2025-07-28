<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function show(Patient $patient)
    {
        // Show the anamnesis for the given patient
        return view('histories.show', [
            'patient' => $patient,
        ]);
    }
}
