<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstallationPackage;
use Illuminate\Http\Request;

class InstallationPackageController extends Controller
{
    public function index()
    {
        $packages = InstallationPackage::orderBy('category')->orderBy('sort_order')->get();
        return view('admin.installation-packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.installation-packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'price_unit' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        InstallationPackage::create($validated);

        return redirect()->route('admin.installation-packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(InstallationPackage $installationPackage)
    {
        return view('admin.installation-packages.edit', compact('installationPackage'));
    }

    public function update(Request $request, InstallationPackage $installationPackage)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'price_unit' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $installationPackage->update($validated);

        return redirect()->route('admin.installation-packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(InstallationPackage $installationPackage)
    {
        $installationPackage->delete();
        return redirect()->route('admin.installation-packages.index')->with('success', 'Package deleted successfully.');
    }
}
