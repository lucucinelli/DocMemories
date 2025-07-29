<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NextPathologicalHistory;

class NextPathologicalHistoryController extends Controller
{
  public function newNextPathologicalHistory(Request $request, $patientId)
    {
        $incomingData = $request->validate([
            'next_date' => ['required', 'string', 'max:255'],
            'next_type' => ['required', 'string', 'max:255'],
            'next_name' => ['required', 'string', 'max:255'],
            'next_cause' => ['required', 'string', 'max:255'],
            'next_effect' => ['required', 'string', 'max:255'],
            'next_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $nextHistory = new NextPathologicalHistory();
        $nextHistory->date = $incomingData['next_date'];
        $nextHistory->type = $incomingData['next_type'];
        $nextHistory->name = $incomingData['next_name'];
        $nextHistory->cause = $incomingData['next_cause'];
        $nextHistory->effect = $incomingData['next_effect'];
        $nextHistory->note = $incomingData['next_note'];
        $nextHistory->patient_id = $patientId;
        $nextHistory->save();

        return response()->json(['message' => 'Next pathological history created successfully.', 'id' => $nextHistory->id], 201);
    }

    public function editNextPathologicalHistory(Request $request, $nextHistoryId)
    {
        $incomingData = $request->validate([
            'next_date' => ['required', 'string', 'max:255'],
            'next_type' => ['required', 'string', 'max:255'],
            'next_name' => ['required', 'string', 'max:255'],
            'next_cause' => ['required', 'string', 'max:255'],
            'next_effect' => ['required', 'string', 'max:255'],
            'next_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $nextHistory = NextPathologicalHistory::findOrFail($nextHistoryId);
        $nextHistory->date = $incomingData['next_date'];
        $nextHistory->type = $incomingData['next_type'];
        $nextHistory->name = $incomingData['next_name'];
        $nextHistory->cause = $incomingData['next_cause'];
        $nextHistory->effect = $incomingData['next_effect'];
        $nextHistory->note = $incomingData['next_note'];
        $nextHistory->save();

        return response()->json(['message' => 'Next pathological history updated successfully.'], 200);
    }

    public function deleteNextPathologicalHistory($nextHistoryId)
    {
        $nextHistory = NextPathologicalHistory::findOrFail($nextHistoryId);
        $nextHistory->delete();

        return response()->json(['message' => 'Next pathological history deleted successfully.'], 200);
    }
}
