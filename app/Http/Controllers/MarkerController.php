<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use Illuminate\Http\Request;

class MarkerController extends Controller
{
    /**
     * Display a listing of the markers.
     */
    public function index()
    {
        $markers = Marker::all();
        return view('markers.index', compact('markers'));
    }

    /**
     * Show the form for creating a new marker.
     */
    public function create()
    {
        return view('markers.create');
    }

    /**
     * Store a newly created marker in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'nullable',
        ]);

        Marker::create($validatedData);

        return redirect()->route('index')
                        ->with('success', 'Marker created successfully.');
    }

    /**
     * Show the form for editing the specified marker.
     */
    public function edit(Marker $marker)
    {
        return view('markers.edit');
    }

    /**
     * Update the specified marker in storage.
     */
    public function update(Request $request, Marker $marker)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'nullable',
        ]);

        $marker->update($validatedData);

        return redirect()->route('index')
                        ->with('success', 'Marker updated successfully');
    }

    /**
     * Remove the specified marker from storage.
     */
    public function destroy(Marker $marker)
    {
        $marker->delete();

        return redirect()->route('index')
                        ->with('success', 'Marker deleted successfully');
    }
}

