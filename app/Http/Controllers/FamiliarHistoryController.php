<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamiliarHistory;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FamiliarHistoryExport;
use App\Models\Patient;

class FamiliarHistoryController extends Controller
{
    public function newFamiliarHistory(Request $request, Patient $patient)
    {
        $incomingData = $request->validate([
            'allergy' => ['required', 'string', 'max:255'],
            'relative' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $incomingData['patient_id'] = $patient->id;

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

    public function exportFamiliarHistories(){
        return Excel::download(new FamiliarHistoryExport(), 'familiar_histories.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="familiar_histories.csv"',
            'Content-Transfer-Encoding' => 'binary',
            'charset' => 'UTF-8',
            'Content-Encoding' => 'UTF-8',
        ]);
    }
}
