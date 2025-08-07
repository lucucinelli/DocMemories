<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
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
        $other = Patient::where('gender','Altro')->count();

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
            'other' => $other
        ]
        );
    }
}
