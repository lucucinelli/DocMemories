<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    public function handle($request, Closure $next)
    {
        // Recupero l'ultimo parametro dell'URL
        $patient = $request->route('patient'); // istanza di Patient
        
        if (!$patient) {
            abort(404, 'Oggetto non trovato');
        }

        // Controllo l'ownership
        if ($patient->user_id !== Auth::id()) {
            abort(403, 'Accesso negato');
        }

        return $next($request);
    }
}