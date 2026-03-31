<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QualityBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QualityBrandController extends Controller
{
    public function index()
    {
        $brands = QualityBrand::orderBy('sort_order')->get();
        $settings = \App\Models\SiteSetting::where('group', 'quality')->get()->pluck('value', 'key');
        return view('quality-brands.index', compact('brands', 'settings'));
    }

    public function create()
    {
        return view('quality-brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo_file' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('logo_file')) {
            $validated['logo'] = $request->file('logo_file')->store('quality-brands', 'public');
        }

        unset($validated['logo_file']);

        QualityBrand::create($validated);

        return redirect()->route('admin.quality-brands.index')->with('success', 'Quality Brand created successfully.');
    }

    public function edit(QualityBrand $qualityBrand)
    {
        return view('quality-brands.edit', compact('qualityBrand'));
    }

    public function update(Request $request, QualityBrand $qualityBrand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo_file' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('logo_file')) {
            if ($qualityBrand->logo && Storage::disk('public')->exists($qualityBrand->logo)) {
                Storage::disk('public')->delete($qualityBrand->logo);
            }
            $validated['logo'] = $request->file('logo_file')->store('quality-brands', 'public');
        }

        unset($validated['logo_file']);

        $qualityBrand->update($validated);

        return redirect()->route('admin.quality-brands.index')->with('success', 'Quality Brand updated successfully.');
    }

    public function destroy(QualityBrand $qualityBrand)
    {
        if ($qualityBrand->logo && Storage::disk('public')->exists($qualityBrand->logo)) {
            Storage::disk('public')->delete($qualityBrand->logo);
        }
        $qualityBrand->delete();
        return redirect()->route('admin.quality-brands.index')->with('success', 'Quality Brand deleted successfully.');
    }
}
