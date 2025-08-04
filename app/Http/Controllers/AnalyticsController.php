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

        $labels = $results->pluck('gender') ?? ['F', 'M', 'Altro'];
        $counts = $results->pluck('total') ?? [0, 0, 0];

        return response()->json([
            'labels' => $labels,
            'counts' => $counts
        ]);
    }

    public function analyzedPatology(Request $request)
    {
        $incomingData = $request->validate([
            'fromDate' => ['date'],
            'toDate' => ['date'],
            'patology' => ['string']
        ]);
        $userId = Auth::id();
        $results = DB::table('visits')
            ->select('patients.gender', DB::raw('count(*) as total'))
            ->join('patients', 'visits.patient_id', '=', 'patients.id')
            ->where('visits.user_id', $userId)
            ->where('visits.diagnosis', 'LIKE', '%' . $incomingData['patology'] . '%')
            ->whereBetween('visits.visit_date', [$incomingData['fromDate'] ?? '1970-01-01', $incomingData['toDate'] ?? now()->format('Y-m-d')])
            ->groupBy('patients.gender')
            ->get();

        $labels = $results->pluck('gender');
        $counts = $results->pluck('total');
        if ($labels->isEmpty() || $counts->isEmpty()) {
            $message = 'empty';
        } else {
            $message = 'not empty';
        }
    
        return response()->json([
            'message' => $message,
            'labels' => $labels,
            'counts' => $counts
        ]);
    }
}
