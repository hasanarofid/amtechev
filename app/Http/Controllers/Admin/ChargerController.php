<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Charger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChargerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chargers = Charger::all();
        return view('chargers.index', compact('chargers'));
    }

    public function create()
    {
        return view('chargers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|string',
            'image_file' => 'nullable|image|max:10240',
            'is_featured' => 'nullable',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image_file')) {
            $validated['image_url'] = $request->file('image_file')->store('chargers', 'public');
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($request->name);

        Charger::create($validated);

        return redirect()->route('admin.chargers.index')->with('success', 'Charger created successfully.');
    }

    public function show(Charger $charger)
    {
        return view('chargers.show', compact('charger'));
    }

    public function edit(Charger $charger)
    {
        return view('chargers.edit', compact('charger'));
    }

    public function update(Request $request, Charger $charger)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|string',
            'image_file' => 'nullable|image|max:10240',
            'is_featured' => 'nullable',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image_file')) {
            if ($charger->image_url && Storage::disk('public')->exists($charger->image_url)) {
                Storage::disk('public')->delete($charger->image_url);
            }
            $validated['image_url'] = $request->file('image_file')->store('chargers', 'public');
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($request->name);

        $charger->update($validated);

        return redirect()->route('admin.chargers.index')->with('success', 'Charger updated successfully.');
    }

    public function destroy(Charger $charger)
    {
        $charger->delete();
        return redirect()->route('admin.chargers.index')->with('success', 'Charger deleted successfully.');
    }
}
