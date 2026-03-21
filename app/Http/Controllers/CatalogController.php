<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charger;
use App\Models\SiteSetting;

class CatalogController extends Controller
{
    public function index()
    {
        $chargers = Charger::all();
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('frontend.catalog.index', compact('chargers', 'settings'));
    }

    public function show($id)
    {
        $charger = Charger::findOrFail($id);
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('frontend.catalog.show', compact('charger', 'settings'));
    }
}
