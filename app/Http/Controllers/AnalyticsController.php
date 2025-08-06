<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use DateTime;
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

    public function persChart(Request $request){
        $incomingData = $request->validate([
            'chart-type-stepper' => ['string', 'required'],
            'groupBy' => ['string', 'required'],
            'date_from-stepper' => ['required'],
            'date_to-stepper' => ['required'],
            'age-range' => ['string', 'required'],
            'age-value-min' => ['integer', 'nullable'],
            'age-value-max' => ['integer', 'nullable'],
            'age-value' => ['integer', 'nullable'],
            'allergy' => ['array', 'nullable'],
            'venom' => ['array', 'nullable'],
            'medicine' => ['array', 'nullable'],
            'dermatitis' => ['array', 'nullable'],
        ]);

        $user_id = Auth::user()->id;
        $type = $incomingData['chart-type-stepper'];
        $radio = $incomingData['groupBy'];
        $age = $incomingData['age-range'];
        if ($radio == 'year'){
            $date_from = $incomingData['date_from-stepper'] . '-01-01';
            $date_to = $incomingData['date_to-stepper'] . '-01-01';
            $query1 = DB::table('visits')
                ->select(DB::raw('YEAR(visits.visit_date) as year'),DB::raw('count(DISTINCT patients.id) as total'))
                ->join('patients', 'visits.patient_id', '=', 'patients.id')
                ->where('visits.user_id', '=', $user_id)
                ->whereBetween('visits.visit_date', [$date_from, $date_to]);
        } else {
            $date_from = $incomingData['date_from-stepper'];
            $date_to = $incomingData['date_to-stepper'];
            $query1 = DB::table('visits')
                ->select('patients.gender', DB::raw('count(*) as total'))
                ->join('patients', 'visits.patient_id', '=', 'patients.id')
                ->where('visits.user_id', '=', $user_id)
                ->whereBetween('visits.visit_date', [$date_from, $date_to]);
        }

        // selezione per età
        if ($age == 'compreso'){
            $min_age = $incomingData['age-value-min'];
            $min_date = self::toDate($min_age);
            $max_age = $incomingData['age-value-max'];
            $max_date = self::toDate($max_age);
            $query2 = $query1->whereBetween('patients.birthdate', [$min_date, $max_date]);
        } elseif ($age == '>'){
            $min_age = $incomingData['age-value'];
            $minore = self::toDate($min_age);
            $query2 = $query1->where('patients.birthdate', '<=', $minore);
        } elseif ($age == '<') {
            $max_age = $incomingData['age-value'];
            $maggiore = self::toDate($max_age);
            $query2 = $query1->where('patients.birthdate', '<=', $maggiore);
        } else{
            $query2 = $query1;
        }

        $allergy = $incomingData['allergy'] ?? [];
        $venom = $incomingData['venom'] ?? [];
        $medicine = $incomingData['medicine'] ?? [];
        $dermatitis = $incomingData['dermatitis'] ?? [];

        $query3 = $query2->where(function ($queryAppoggio) use ($allergy,$venom,$medicine,$dermatitis) {
            if (!empty($allergy)) {
                $queryAppoggio->whereIn('visits.diagnosis', $allergy);
            }
            if (!empty($venom)) {
                $queryAppoggio->orWhereIn('visits.diagnosis', $venom);
            }
            if (!empty($medicine)) {
                $queryAppoggio->orWhereIn('visits.diagnosis', $medicine);
            }
            if (!empty($dermatitis)) {
                $queryAppoggio->orWhereIn('visits.diagnosis', $dermatitis);
            }
        });

        if ($radio == 'year'){
            $query4 = $query3->groupBy(DB::raw('YEAR(visits.visit_date)'))->orderBy('year', 'asc');
            $result = $query4->get();
            $labels = $result->pluck('year');
        } else {
            $query4 = $query3->groupBy('patients.gender');
            $result = $query4->get();
            $labels = $result->pluck('gender');
        }

        
        $counts = $result->pluck('total');

        return response()->json([
            'type' => $type,
            'labels' => $labels,
            'counts' => $counts,
        ]);
    }

    static function toDate($age){
        $birthYear = date('Y') - $age;
        return "$birthYear-01-01";
    }
}
