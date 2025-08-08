<?php

namespace App\Http\Controllers;

use DateTime;
use IntlDateFormatter;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $dailyVisits = Auth::user()->visits->where('visit_date', '>=', now()->format('Y-m-d'))->count();
        $weeklyVisits = Auth::user()->visits->where('visit_date', '>=', now()->subDays(7)->format('Y-m-d'))->count();
        $monthlyVisits = Auth::user()->visits->where('visit_date', '>=', now()->subDays(30)->format('Y-m-d'))->count();
        $annualVisits = Auth::user()->visits->where('visit_date', '>=', now()->subDays(365)->format('Y-m-d'))->count();

        $dailyIntramoenia = Auth::user()->visits->where('visit_date', '>=', now()->format('Y-m-d'))->where('reservation', 'Intramoenia')->count();
        $weeklyIntramoenia = Auth::user()->visits->where('visit_date', '>=', now()->subDays(7)->format('Y-m-d'))->where('reservation', 'Intramoenia')->count();
        $monthlyIntramoenia = Auth::user()->visits->where('visit_date', '>=', now()->subDays(30)->format('Y-m-d'))->where('reservation', 'Intramoenia')->count();
        $annualIntramoenia = Auth::user()->visits->where('visit_date', '>=', now()->subDays(365)->format('Y-m-d'))->where('reservation', 'Intramoenia')->count();

        $dailyIstituzionali = Auth::user()->visits->where('visit_date', '>=', now()->format('Y-m-d'))->where('reservation', 'Istituzionale')->count();
        $weeklyIstituzionali = Auth::user()->visits->where('visit_date', '>=', now()->subDays(7)->format('Y-m-d'))->where('reservation', 'Istituzionale')->count();
        $monthlyIstituzionali = Auth::user()->visits->where('visit_date', '>=', now()->subDays(30)->format('Y-m-d'))->where('reservation', 'Istituzionale')->count();
        $annualIstituzionali = Auth::user()->visits->where('visit_date', '>=', now()->subDays(365)->format('Y-m-d'))->where('reservation', 'Istituzionale')->count();

        $m = Patient::where('gender','M')->count();
        $f = Patient::where('gender','F')->count();
        $notSpecified = Patient::where('gender','non specificato')->count();

        return view('dashboard', [
            'dailyVisits' => $dailyVisits,
            'weeklyVisits' => $weeklyVisits,
            'monthlyVisits' => $monthlyVisits,
            'annualVisits' => $annualVisits,
            'dailyIntramoenia' => $dailyIntramoenia,
            'weeklyIntramoenia' => $weeklyIntramoenia,
            'monthlyIntramoenia' => $monthlyIntramoenia,
            'annualIntramoenia' => $annualIntramoenia,
            'dailyIstituzionali' => $dailyIstituzionali,
            'weeklyIstituzionali' => $weeklyIstituzionali,
            'monthlyIstituzionali' => $monthlyIstituzionali,
            'annualIstituzionali' => $annualIstituzionali,
            'm' => $m,
            'f' => $f,
            'notSpecified' => $notSpecified
        ]
        );
    }

    public function chartVisits(Request $request){
        $incomingData = $request->validate([
            'type' => ['required'],
            'from' => ['required'],
            'to' => ['required'],
            'reference' => ['nullable']
        ]);

        // Process the validated data
        $from = $incomingData['from'];
        $to = $incomingData['to'];
        $reference = $incomingData['reference'];
         
        if($incomingData['type'] == 'years') {
            $from = $from . '-01-01';
            $to = $to . '-12-31';
            $reportVisits = DB::table('visits')
                ->select(DB::raw('YEAR(visit_date) as year'),'gender', DB::raw('COUNT(*) as total'))            
                ->join('patients','patient_id','=','patients.id')
                ->where('user_id','=',Auth::user()->id)
                ->whereBetween('visit_date', [$from, $to])
                ->groupBy('year','gender')
                ->orderBy('year', 'asc')
                ->orderBy('gender', 'asc')
                ->get();

            $grouped = [];

            foreach ($reportVisits as $row) {
                $grouped[$row->gender][$row->year] = $row->total;
            }

            $labels = collect($reportVisits)->pluck('year')->unique()->sort()->values();

            $data = [
                'labels' => $labels,
                'datasets' => []
            ];

            $genders = ['M' => 'Uomo', 'F' => 'Donna', 'non specificato' => 'Non specificato'];

            foreach ($genders as $genderCode => $genderLabel) {
                $dataset = [
                    'label' => $genderLabel,
                    'data' => [],
                    'backgroundColor' => match($genderCode) {
                        'M' => 'rgba(54, 162, 235, 0.6)',
                        'F' => 'rgba(255, 99, 132, 0.6)',
                        default => 'rgba(201, 203, 207, 0.6)',
                    },
                ];

                foreach ($labels as $year) {
                    $dataset['data'][] = $grouped[$genderCode][$year] ?? 0;
                }

                $data['datasets'][] = $dataset;
            }

            return response()->json($data);
        }else{
            $from = $reference . '-' . $from . '-01';
            $to = $reference . '-' . $to . '-31';
            $reportVisits = DB::table('visits')
                ->select(DB::raw('MONTH(visit_date) as month'),'gender', DB::raw('COUNT(*) as total'))            
                ->join('patients','patient_id','=','patients.id')
                ->where('user_id','=',Auth::user()->id)
                ->whereBetween('visit_date', [$from, $to])
                ->groupBy('month','gender')
                ->orderBy('month', 'asc')
                ->orderBy('gender', 'asc')
                ->get();

            $grouped = [];

            foreach ($reportVisits as $row) {
                $grouped[$row->gender][$row->month] = $row->total;
            }

            $labels = collect($reportVisits)->pluck('month')->unique()->sort()->values();
            
            
            $data = [
                'labels' => $labels,
                'datasets' => []
            ];

            $genders = ['M' => 'Uomo', 'F' => 'Donna', 'non specificato' => 'Non specificato'];

            foreach ($genders as $genderCode => $genderLabel) {
                $dataset = [
                    'label' => $genderLabel,
                    'data' => [],
                    'backgroundColor' => match($genderCode) {
                        'M' => 'rgba(54, 162, 235, 0.6)',
                        'F' => 'rgba(255, 99, 132, 0.6)',
                        default => 'rgba(201, 203, 207, 0.6)',
                    },
                ];

                foreach ($labels as $month) {
                    $dataset['data'][] = $grouped[$genderCode][$month] ?? 0;
                }

                $data['datasets'][] = $dataset;
            }

            $labels = $labels->map(function($month) {
                return self::getMonthName($month);
            });
            $data['labels'] = $labels;
            return response()->json($data);
        }
        
    }   

    static function getMonthName($monthNumber) {
        $months = [
            1 => 'gennaio',
            2 => 'febbraio',
            3 => 'marzo',
            4 => 'aprile',
            5 => 'maggio',
            6 => 'giugno',
            7 => 'luglio',
            8 => 'agosto',
            9 => 'settembre',
            10 => 'ottobre',
            11 => 'novembre',
            12 => 'dicembre'
        ];
        return $months[$monthNumber] ?? '';
    }
}

