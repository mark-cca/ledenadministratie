<?php

namespace App\Http\Controllers;

use App\Models\Boekjaar;
use App\Models\Familie;
use App\Models\Familielid;
use App\Models\Contributie;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Toon het dashboard met gegevens voor de widgets.
     *
     * @return View
     */
    public function index()
    {
        try {
            $boekjaren = Boekjaar::all();
            $totalFamilies = Familie::count();
            $totalFamilieleden = Familielid::count();

            // Haal het huidige boekjaar op uit de database of gebruik het huidige jaar
            $currentYear = Carbon::now()->year;
            $currentBoekjaar = Boekjaar::where('jaar', $currentYear)->first();

            if (!$currentBoekjaar) {
                $currentBoekjaar = (object)['jaar' => $currentYear];
            }

            // Haal alle instanties van Familielid op
            $familielidInstances = Familielid::all();

            // Bereken de totale contributie door handmatig op te tellen
            $totalContribution = number_format($familielidInstances->sum(function ($familielid) {
                return $familielid->getContributiePrijsAttribute() ?? 0;
            }), 2, ',', '.');

            return view('dashboard', compact('boekjaren', 'totalFamilies', 'totalFamilieleden', 'currentBoekjaar', 'totalContribution'));
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.', 'Fout');
            return redirect()->back();
        }
    }
}
