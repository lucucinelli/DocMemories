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
            ->select('patients.gender', DB::raw('count(DISTINCT patients.id) as total'))
            ->join('patients', 'visits.patient_id', '=', 'patients.id')
            ->where('visits.user_id', $userId)
            ->whereBetween('visits.visit_date', [$incomingData['fromDate'] ?? '1970-01-01', $incomingData['toDate'] ?? now()->format('Y-m-d')])
            ->groupBy('patients.gender')
            ->get();

        $labels = $results->pluck('gender') ?? ['F', 'M', 'non specificato'];
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
            'patology' => ['string'],
        ]);
        if ($incomingData['patology'] == 'alimenti') {
            $values = ['%pesce%', '%latte%', '%uova%', '%frutta%'];
        } elseif ($incomingData['patology'] == 'dermatite') {
            $values = ['%irritativa%', '%nichel%', '%cobalto cloruro%', '%parafenilendiammina%', '%orticaria%', '%angioedema%', '%mastocitosi%', '%varicosa%'];     
        } elseif ($incomingData['patology'] == 'imenotteri'){
            $values = ['%veleno%', '%vespa%', '%cabro%', '%polistes%', '%dominulus%', '%ape%'];
        } else {
            $values = ['%' . $incomingData['patology'] . '%'];
        }
        $userId = Auth::id();
        $results = DB::table('visits')
            ->select('patients.gender', DB::raw('count(DISTINCT patients.id) as total'))
            ->join('patients', 'visits.patient_id', '=', 'patients.id')
            ->where('visits.user_id', $userId)
            ->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhere('visits.diagnosis', 'LIKE', $value);
                }
            })
            ->whereBetween('visits.visit_date', [$incomingData['fromDate'] ?? '1970-01-01', $incomingData['toDate'] ?? now()->format('Y-m-d')])
            ->groupBy('patients.gender')
            ->orderBy('patients.gender', 'asc')
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

        $userId = Auth::id();
        $type = $incomingData['chart-type-stepper'];
        $radio = $incomingData['groupBy'];
         if ($radio == 'year'){
            $date_from = $incomingData['date_from-stepper'] . '-01-01';
            $date_to = $incomingData['date_to-stepper'] . '-12-31';
            $pazienti = DB::table('patients')
                ->select(DB::raw('YEAR(visits.visit_date) as year'), DB::raw('count(DISTINCT patients.id) as total'))
                ->join('visits', 'patients.id', '=', 'visits.patient_id')
                ->where('visits.user_id', $userId)
                ->whereBetween('visit_date', [$date_from, $date_to])
                ->groupBy('year')
                ->orderBy('year', 'asc');
        } else {
            $date_from = $incomingData['date_from-stepper'];
            $date_to = $incomingData['date_to-stepper'];
            //pazienti ragguppati per sesso
            $pazienti = DB::table('patients')
                ->select('gender', DB::raw('count(DISTINCT patients.id) as total'))
                ->join('visits', 'patients.id', '=', 'visits.patient_id')
                ->where('visits.user_id', $userId)
                ->whereBetween('visit_date', [$date_from, $date_to])
                ->groupBy('gender')
                ->orderBy('gender','asc');
        }

        // selezione per età
        if ($incomingData['age-range'] == 'compreso'){
            $min_age = $incomingData['age-value-min'];
            $max_age = $incomingData['age-value-max'];
            $min_date = self::toDate($min_age, true);
            $max_date = self::toDate($max_age);
            $pazienti = $pazienti->whereBetween('patients.birthdate', [$max_date, $min_date]);
        } elseif ($incomingData['age-range'] == '>'){
            $min_age = $incomingData['age-value'];
            $minore = self::toDate($min_age, true);
            $pazienti = $pazienti->where('patients.birthdate', '<=', $minore);
        } elseif ($incomingData['age-range'] == '<') {
            $max_age = $incomingData['age-value'];
            $maggiore = self::toDate($max_age);
            $pazienti = $pazienti->where('patients.birthdate', '>=', $maggiore);
        } else{
            $pazienti = $pazienti;
        }
        // selezione per checkbox
        $allergy = $incomingData['allergy'] ?? [];
        $venom = $incomingData['venom'] ?? [];
        $medicine = $incomingData['medicine'] ?? [];
        $dermatitis = $incomingData['dermatitis'] ?? [];

        $pazienti = $pazienti->where(function ($queryAppoggio) use ($allergy,$venom,$medicine,$dermatitis) {
            if (!empty($allergy)) {
                $queryAppoggio->orWhere(function($q) use ($allergy) {
                    foreach ($allergy as $item) {
                        $q->orWhere('visits.diagnosis', 'like', "%{$item}%");
                    }
                });
            }
            if (!empty($venom)) {
                $queryAppoggio->orWhere(function($q) use ($venom) {
                    foreach ($venom as $item) {
                        $q->orWhere('visits.diagnosis', 'like', "%{$item}%");
                    }
                });
            }
            if (!empty($medicine)) {
                $queryAppoggio->orWhere(function($q) use ($medicine) {
                    foreach ($medicine as $item) {
                        $q->orWhere('visits.diagnosis', 'like', "%{$item}%");
                    }
                });
            }
            if (!empty($dermatitis)) {
                $queryAppoggio->orWhere(function($q) use ($dermatitis) {
                    foreach ($dermatitis as $item) {
                        $q->orWhere('visits.diagnosis', 'like', "%{$item}%");
                    }
                });
            }
        });
        $pazienti = $pazienti->get();

        if($radio == 'year'){
            $labels = $pazienti->pluck('year')->map(fn($year) => (string)$year);
        }else{
            $labels = $pazienti->pluck('gender');
        }
        $counts = $pazienti->pluck('total');

        if ($counts->isEmpty()){
            $message = "empty";
        } else {
            $message = "not empty";
        }
        return response()->json([
            'message'=> $message,
            'type' => $type,
            'labels' => $labels,
            'counts' => $counts,
        ]);
    }

    static function toDate($age, $max = false){
        $year = (integer) date('Y');
        $birthYear = $year - $age;
        $birthYear = (string) $birthYear;
        if ($max) {
            return $birthYear . "-12-31";
        }
        return $birthYear . "-01-01";
    }
}
