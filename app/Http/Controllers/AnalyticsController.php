<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function numberOfPatients(Request $request)
    {
        $incomingData = $request->validate([
            'fromDate' => ['date'],
            'toDate' => ['date'],
        ]);
        $userId = Auth::id();
        $results = DB::table('visits')
            ->select('patients.gender', DB::raw('count(*) as total'))
            ->join('patients', 'visits.patient_id', '=', 'patients.id')
            ->where('visits.user_id', $userId)
            ->whereBetween('visits.visit_date', [$incomingData['fromDate'] ?? '1970-01-01', $incomingData['toDate'] ?? now()->format('Y-m-d')])
            ->groupBy('patients.gender')
            ->get();

        $labels = $results->pluck('gender');
        $counts = $results->pluck('total');

        return response()->json([
            'labels' => $labels,
            'counts' => $counts
        ]);
    }
}
