<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFamilielidRequest;
use App\Http\Requests\UpdateFamilielidRequest;
use App\Models\Familie;
use App\Models\Familielid;
use App\Models\SoortLid;
use Illuminate\Support\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class FamilielidController extends Controller
{
    /**
     * Toon een lijst van de familieleden.
     *
     * @return View
     */
    public function index()
    {
        //
    }

    /**
     * Toon het formulier voor het aanmaken van een nieuw familielid.
     *
     * @param Familie $familie
     * @return View
     */
    public function create(Familie $familie)
    {
        return view('familieleden.create', compact('familie'));
    }

    /**
     * Sla een nieuw familielid op in de database.
     *
     * @param StoreFamilielidRequest $request
     * @param Familie $familie
     * @return RedirectResponse
     */
    public function store(StoreFamilielidRequest $request, Familie $familie)
    {
        try {
            $geboortedatum = $request->geboortedatum;
            $geboortejaar = Carbon::parse($geboortedatum)->year;
            $huidigJaar = Carbon::now()->year;
            $leeftijd = $huidigJaar - $geboortejaar;

            // Stel het standaard "soort lid" in
            $standaardSoortLid = SoortLid::where('naam', 'Jeugd')->first();

            // Bepaal het juiste "soort lid" op basis van leeftijd
            if ($leeftijd >= 8 && $leeftijd <= 12) {
                $standaardSoortLid = SoortLid::where('naam', 'Aspirant')->first();
            } elseif ($leeftijd >= 13 && $leeftijd <= 17) {
                $standaardSoortLid = SoortLid::where('naam', 'Junior')->first();
            } elseif ($leeftijd >= 18 && $leeftijd <= 50) {
                $standaardSoortLid = SoortLid::where('naam', 'Senior')->first();
            } elseif ($leeftijd >= 51) {
                $standaardSoortLid = SoortLid::where('naam', 'Oudere')->first();
            }

            $familie->familieleden()->create([
                'naam' => $request->naam,
                'geboortedatum' => $geboortedatum,
                'soort_lid_id' => $standaardSoortLid->id,
            ]);

            notify()->success('Familielid is toegevoegd.','Gelukt');
            return redirect()->route('families.show', $familie);
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.','Fout');
            return redirect()->back();
        }
    }

    /**
     * Toon de gegevens van een specifiek familielid.
     *
     * @param Familielid $familielid
     * @return View
     */
    public function show(Familielid $familielid)
    {
        //
    }

    /**
     * Toon het formulier om een bestaand familielid te bewerken.
     *
     * @param Familielid $familielid
     * @return View
     */
    public function edit(Familielid $familielid)
    {
        return view('familieleden.edit', compact('familielid'));
    }

    /**
     * Werk de gegevens van een bestaand familielid bij in de database.
     *
     * @param UpdateFamilielidRequest $request
     * @param Familielid $familielid
     * @return RedirectResponse
     */
    public function update(UpdateFamilielidRequest $request, Familielid $familielid)
    {
        try {
            $familielid->update($request->validated());

            notify()->success('Familielid is bijgewerkt.','Gelukt');
            return redirect()->route('families.show', $familielid->familie_id);
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.','Fout');
            return redirect()->back();
        }
    }

    /**
     * Verwijder een familielid uit de database.
     *
     * @param Familielid $familielid
     * @return RedirectResponse
     */
    public function destroy(Familielid $familielid)
    {
        try {
            $familieId = $familielid->familie_id;

            $familielid->delete();

            notify()->success('Familielid is verwijderd.', 'Gelukt');
            return redirect()->route('families.show', ['familie' => $familielid->familie_id]);
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.', 'Fout');
            return redirect()->back();
        }
    }
}
