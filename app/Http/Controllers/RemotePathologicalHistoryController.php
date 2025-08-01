<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RemotePathologicalHistory;

class RemotePathologicalHistoryController extends Controller
{
    public function newRemotePathologicalHistory(Request $request, $patientId)
    {
        $incomingData = $request->validate([
            'remote_date' => ['required', 'string', 'max:255'],
            'remote_type' => ['required', 'string', 'max:255'],
            'remote_description' => ['required', 'string', 'max:255'],
            'remote_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $remoteHistory = new RemotePathologicalHistory();
        $remoteHistory->date = $incomingData['remote_date'];
        $remoteHistory->type = $incomingData['remote_type'];
        $remoteHistory->description = $incomingData['remote_description'];
        $remoteHistory->note = $incomingData['remote_note'];
        $remoteHistory->patient_id = $patientId;
        $remoteHistory->save();

        return response()->json(['message' => 'Remote pathological history created successfully.', 'id' => $remoteHistory->id], 201);
    }

    public function editRemotePathologicalHistory(Request $request, $remoteHistoryId)
    {
        $incomingData = $request->validate([
            'remote_date' => ['required', 'string', 'max:255'],
            'remote_type' => ['required', 'string', 'max:255'],
            'remote_description' => ['required', 'string', 'max:255'],
            'remote_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $remoteHistory = RemotePathologicalHistory::findOrFail($remoteHistoryId);
        $remoteHistory->date = $incomingData['remote_date'];
        $remoteHistory->type = $incomingData['remote_type'];
        $remoteHistory->description = $incomingData['remote_description'];
        $remoteHistory->note = $incomingData['remote_note'];
        $remoteHistory->save();
        
        return response()->json(['message' => 'Remote pathological history updated successfully.'], 200);
    }

    public function deleteRemotePathologicalHistory($remoteHistoryId)
    {
        $remoteHistory = RemotePathologicalHistory::findOrFail($remoteHistoryId);
        $remoteHistory->delete();

        return response()->json(['message' => 'Remote pathological history deleted successfully.'], 200);
    }
}
