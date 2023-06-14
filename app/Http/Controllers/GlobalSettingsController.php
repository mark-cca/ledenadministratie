<?php

namespace App\Http\Controllers;

use App\Models\Boekjaar;
use App\Models\GlobalSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class GlobalSettingsController extends Controller
{
    public function index()
    {
        try {
            $boekjaren = Boekjaar::pluck('jaar', 'id')->toArray();
            $settings = GlobalSettings::first();
            return view('settings.index', compact('settings', 'boekjaren'));
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.','Fout');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        try {
            $settings = GlobalSettings::first();
            $settings->update($request->all());
            notify()->success('Instellingen succesvol bijgewerkt!','Gelukt');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e);
            notify()->error('Er is een fout opgetreden. Probeer het later opnieuw.','Fout');
            return redirect()->back();
        }
    }
}
