<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContributieRequest;
use App\Http\Requests\UpdateContributieRequest;
use App\Models\Boekjaar;
use App\Models\Contributie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContributieController extends Controller
{

    public function viewBoekjaar(Boekjaar $boekjaar)
    {
        try {
            $contributies = $boekjaar->contributies;
            return view('boekjaren.view', compact('boekjaar', 'contributies'));
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.', 'Fout');
            return redirect()->back();
        }
    }

    public function editBoekjaar(Boekjaar $boekjaar)
    {
        try {
            $contributies = $boekjaar->contributies;
            return view('boekjaren.edit', compact('boekjaar', 'contributies'));
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.', 'Fout');
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContributieRequest $request
     * @return RedirectResponse
     */
    public function store(StoreContributieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Contributie $contributie
     * @return View
     */
    public function show(Contributie $contributie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contributie $contributie
     * @return View
     */
    public function edit(Contributie $contributie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Contributie $contributie
     * @return RedirectResponse
     */
    public function update(Request $request, Contributie $contributie)
    {
        try {
            $contributie->update([
                'bedrag' => $request->bedrag,
            ]);

            return redirect()->route('contributions.edit', $contributie->boekjaar_id);
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.', 'Fout');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contributie $contributie
     * @return void
     */
    public function destroy(Contributie $contributie)
    {
        //
    }
}
