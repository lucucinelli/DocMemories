<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamiliarHistory;

class FamiliarHistoryController extends Controller
{
    public function newFamiliarHistory(Request $request, $patientId)
    {
        $incomingData = $request->validate([
            'allergy' => ['required', 'string', 'max:255'],
            'relative' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $incomingData['patient_id'] = $patientId;

        $familiarHistory = FamiliarHistory::create($incomingData);
        
        return response()->json(['message' => 'Familiar history created successfully.', 'id' => $familiarHistory->id], 201);
    }

    public function editFamiliarHistory(Request $request, $familiarHistoryId)
    {
        $incomingData = $request->validate([
            'allergy' => ['required', 'string', 'max:255'],
            'relative' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $familiarHistory = FamiliarHistory::findOrFail($familiarHistoryId);
        $familiarHistory->update($incomingData);
        return response()->json(['message' => 'Familiar history updated successfully.'], 200);
    }

    public function deleteFamiliarHistory($familiarHistoryId)
    {
        $familiarHistory = FamiliarHistory::findOrFail($familiarHistoryId);
        $familiarHistory->delete();

        return response()->json(['message' => 'Familiar history deleted successfully.'], 200);
    }
}
