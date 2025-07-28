<?php

namespace App\Http\Controllers;

use App\Models\Medicinal;
use App\Models\Visit;
use Illuminate\Http\Request;

class MedicinalController extends Controller
{
    public function newMedicinal(Request $request, Visit $visit)
    {
        $incomingData = $request->validate([
            'med_name' => ['required', 'string', 'max:255'],
            'med_quantity' => ['required', 'string'],
            'med_usage' => ['required', 'string', 'max:255'],
            'med_period' => ['required', 'string', 'max:255'],
        ]);

        $medicinal = new Medicinal();
        $medicinal->name = $incomingData['med_name'];
        $medicinal->quantity = $incomingData['med_quantity'];
        $medicinal->usage = $incomingData['med_usage'];
        $medicinal->period = $incomingData['med_period'];
        $medicinal->visit_id = $visit->id;
        $medicinal->save();

        return response()->json(['message' => 'Medicinal created successfully', 'medicinal' => $medicinal, 'id' => $medicinal->id], 201);
    }

    public function editMedicinal(Request $request, Medicinal $medicinal)
    {
        $incomingData = $request->validate([
            'new_name' => ['required', 'string', 'max:255'],
            'new_quantity' => ['required', 'string'],
            'new_usage' => ['required', 'string', 'max:255'],
            'new_period' => ['required', 'string', 'max:255'],
        ]);

        $medicinal->name = $incomingData['new_name'];
        $medicinal->quantity = $incomingData['new_quantity'];
        $medicinal->usage = $incomingData['new_usage'];
        $medicinal->period = $incomingData['new_period'];
        $medicinal->save();

        return response()->json(['message' => 'Medicinal updated successfully', 'medicinal' => $medicinal], 200);
    }

    public function deleteMedicinal(Medicinal $medicinal)
    {
        $medicinal->delete();
        return response()->json(['message' => 'Medicinal deleted successfully'], 200);
    }
}
