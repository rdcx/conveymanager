<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PropertyController extends Controller
{
    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        return Inertia::render('Properties/Create');
    }

    /**
     * Store a newly created property in the database.
     */
    public function store(StorePropertyRequest $request): \Illuminate\Http\RedirectResponse
    {
        Property::create([
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'owner_id' => Auth::id(),
        ]);

        return redirect()->route('properties.index')->with('success', 'Property created successfully.');
    }

    /**
     * Display a listing of the properties.
     */
    public function index()
    {
        $properties = Property::where('owner_id', Auth::id())->get();

        return Inertia::render('Properties/Index', [
            'properties' => $properties,
        ]);
    }
}