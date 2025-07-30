<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PhysiologicalHistory;
use Illuminate\Http\Request;

class PhysiologicalHistoryController extends Controller
{
    public function newPhysiologicalHistory(Request $request, Patient $patient)
    {
        $incomingData = $request->validate([
            'birth' => ['nullable', 'string', 'max:255'],
            'atopy' => ['nullable', 'boolean'],
            'nursing' => ['nullable', 'string', 'max:255'],
            'diet' => ['nullable', 'string', 'max:255'],
            'habits' => ['nullable', 'string', 'max:255'],
            'period' => ['nullable', 'string', 'max:255'],
            'period_regularity' => ['nullable', 'string', 'max:255'],
        ]);
        $incomingData['patient_id'] = $patient->id;

        PhysiologicalHistory::create($incomingData);
        return redirect()->route('showHistory', ['patient' => $patient->id])->with('success', 'Storia fisiologica creata con successo.');
    }

    public function editPhysiologicalHistory(Request $request, Patient $patient)
    {
        $incomingData = $request->validate([
            'birth' => ['nullable', 'string', 'max:255'],
            'atopy' => ['nullable', 'boolean'],
            'nursing' => ['nullable', 'string', 'max:255'],
            'diet' => ['nullable', 'string', 'max:255'],
            'habits' => ['nullable', 'string', 'max:255'],
            'period' => ['nullable', 'string', 'max:255'],
            'period_regularity' => ['nullable', 'string', 'max:255'],
        ]);

        $physiologicalHistory = $patient->physiologicalHistory()->get()->first();
        $physiologicalHistory->update($incomingData);

        return response()->json(['success' => true, 'message' => 'Storia fisiologica aggiornata con successo.']);
    }

    public function isPhysiologicalHistorySet(Patient $patient)
    {
        $physiologicalHistory = $patient->physiologicalHistory()->get()->first();
        return response()->json(['success' => !is_null($physiologicalHistory)]);
    }
}
