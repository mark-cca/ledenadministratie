<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFamilieRequest;
use App\Http\Requests\UpdateFamilieRequest;
use App\Models\Familie;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class FamilieController extends Controller
{
    /**
     * Toon een overzicht van alle families.
     *
     * @return View
     */
    public function index()
    {
        try {
            $families = Familie::all();
            return view('families.index', compact('families'));
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.','Fout');
            return redirect()->back();
        }
    }

    /**
     * Toon het formulier om een nieuwe familie toe te voegen.
     *
     * @return View
     */
    public function create()
    {
        return view('families.create');
    }

    /**
     * Sla een nieuwe familie op in de database.
     *
     * @param StoreFamilieRequest $request
     * @return RedirectResponse
     */
    public function store(StoreFamilieRequest $request)
    {
        try {
            $familie = Familie::create([
                'naam' => $request->naam,
                'adres' => $request->adres,
            ]);

            notify()->success('Familie is toegevoegd.','Gelukt');
            return redirect()->route('families.index');
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.','Fout');
            return redirect()->back();
        }
    }

    /**
     * Toon de gegevens van een specifieke familie.
     *
     * @param Familie $familie
     * @return View
     */
    public function show(Familie $familie)
    {
        return view('families.show', compact('familie'));
    }

    /**
     * Toon het formulier om een bestaande familie te bewerken.
     *
     * @param Familie $familie
     * @return View
     */
    public function edit(Familie $familie)
    {
        return view('families.edit', compact('familie'));
    }

    /**
     * Werk de gegevens van een bestaande familie bij in de database.
     *
     * @param UpdateFamilieRequest $request
     * @param Familie $familie
     * @return RedirectResponse
     */
    public function update(UpdateFamilieRequest $request, Familie $familie)
    {
        try {
            $familie->update([
                'naam' => $request->naam,
                'adres' => $request->adres,
            ]);

            notify()->success('Familie is bijgewerkt.','Gelukt');
            return redirect()->route('families.index');
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.','Fout');
            return redirect()->back();
        }
    }

    /**
     * Verwijder een familie uit de database.
     *
     * @param Familie $familie
     * @return RedirectResponse
     */
    public function destroy(Familie $familie)
    {
        try {
            $familie->delete();

            notify()->success('Familie is verwijderd.','Gelukt');
            return redirect()->route('families.index');
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.','Fout');
            return redirect()->back();
        }
    }
}
