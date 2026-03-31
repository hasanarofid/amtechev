<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $allowedGroups = ['general', 'contact', 'footer', 'payment'];
        $settings = \App\Models\SiteSetting::whereIn('group', $allowedGroups)->get()->groupBy('group');
        return view('site-settings.index', compact('settings'));
    }

    public function hero()
    {
        $settings = \App\Models\SiteSetting::where('group', 'hero')->get()->pluck('value', 'key');
        return view('site-settings.hero', compact('settings'));
    }

    public function about()
    {
        $settings = \App\Models\SiteSetting::where('group', 'about')->get()->pluck('value', 'key');
        return view('site-settings.about', compact('settings'));
    }

    public function mission()
    {
        $settings = \App\Models\SiteSetting::where('group', 'mission')->get()->pluck('value', 'key');
        return view('site-settings.mission', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        
        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('settings', 'public');
                \App\Models\SiteSetting::where('key', $key)->update(['value' => $path]);
            } else {
                \App\Models\SiteSetting::where('key', $key)->update(['value' => $value]);
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
