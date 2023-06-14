<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBoekjaarRequest;
use App\Http\Requests\UpdateBoekjaarRequest;
use App\Models\Boekjaar;
use App\Models\GlobalSettings;
use App\Models\SoortLid;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BoekjaarController extends Controller
{
    /**
     * Toon een lijst van de bron.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        try {
            $boekjaren = Boekjaar::all();
            return view('boekjaren.index', compact('boekjaren'));
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.','Fout');
            return redirect()->back();
        }
    }

    /**
     * Toon het formulier voor het maken van een nieuw boekjaar.
     *
     * @return View
     */
    public function create()
    {
        //
    }

    /**
     * Sla een nieuw boekjaar op in de opslag.
     *
     * @param StoreBoekjaarRequest $request
     * @return RedirectResponse
     */
    public function store(StoreBoekjaarRequest $request)
    {
        try {
            // Maak het boekjaar aan
            $boekjaar = Boekjaar::create([
                'jaar' => $request->jaar,
            ]);

            // Bereken en maak de contributies aan voor elk soort lid
            $soortLeden = SoortLid::all();

            foreach ($soortLeden as $soortLid) {
                $bedrag = $this->calculateContributie($soortLid->naam);

                $boekjaar->contributies()->create([
                    'soort_lid_id' => $soortLid->id,
                    'bedrag' => $bedrag,
                    'leeftijd' => $soortLid->omschrijving,
                ]);
            }
            notify()->success('Boekjaar is toegevoegd.','Gelukt');
            return redirect()->route('boekjaren.index');
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.','Fout');
            return redirect()->back();
        }
    }

    /**
     * Toon de opgegeven bron.
     *
     * @param Boekjaar $boekjaar
     * @return View
     */
    public function show(Boekjaar $boekjaar)
    {
        //
    }

    /**
     * Toon het formulier voor het bewerken van de opgegeven bron.
     *
     * @param Boekjaar $boekjaar
     * @return View
     */
    public function edit(Boekjaar $boekjaar)
    {
        //
    }

    /**
     * Werk de opgegeven bron bij in de opslag.
     *
     * @param UpdateBoekjaarRequest $request
     * @param Boekjaar $boekjaar
     * @return RedirectResponse
     */
    public function update(UpdateBoekjaarRequest $request, Boekjaar $boekjaar)
    {
        //
    }

    /**
     * Verwijder de opgegeven bron uit de opslag.
     *
     * @param Boekjaar $boekjaar
     * @return void
     */
    public function destroy(Boekjaar $boekjaar)
    {
        //
    }

    /**
     * Bereken de contributie op basis van het opgegeven soort lid.
     *
     * @param  string  $naam
     * @return float
     */
    private function calculateContributie($naam)
    {
        $soortLid = SoortLid::where('naam', $naam)->first();

        if (!$soortLid) {
            return 0; // Behandel het geval waarin er geen overeenkomstig soort lid is
        }

        $globalSettings = GlobalSettings::first();

        $standaardContributie = $globalSettings->standaard_contributie;
        $korting = 0;

        switch ($soortLid->naam) {
            case 'Jeugd':
                $korting = $globalSettings->jeugd_korting;
                break;
            case 'Aspirant':
                $korting = $globalSettings->aspirant_korting;
                break;
            case 'Junior':
                $korting = $globalSettings->junior_korting;
                break;
            case 'Oudere':
                $korting = $globalSettings->oudere_korting;
                break;
            default:
                $korting = 0;
                break;
        }

        $bedrag = $standaardContributie * (1 - ($korting / 100));
        return round($bedrag, 2);
    }
}
