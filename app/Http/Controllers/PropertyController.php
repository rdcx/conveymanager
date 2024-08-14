<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class PropertyController extends Controller
{
    /**
     * Show the form for creating a new property.
     */
    public function create() : \Inertia\Response
    {
        Gate::authorize('create', Property::class);

        return Inertia::render('Property/Create');
    }

    /**
     * Store a newly created property in the database.
     */
    public function store(StorePropertyRequest $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('store', Property::class);

        Property::create([
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        return redirect()->route('properties.index')->with('success', 'Property created successfully.');
    }

    /**
     * Display a listing of the properties.
     */
    public function index(): \Inertia\Response
    {
        Gate::authorize('index', Property::class);

        $properties = Property::get();

        return Inertia::render('Property/Index', [
            'properties' => $properties,
        ]);
    }
    
    /**
     * Display the specified property.
     */
    public function show(Property $property) : \Inertia\Response
    {
        Gate::authorize('view', $property);
        $property->load(['conveyancingCases', 'conveyancingCases.clients', 'conveyancingCases.conveyancer']);
        return Inertia::render('Property/Show', [
            'property' => $property,
            'conveyancingCases' => $property->conveyancingCases,
        ]);
    }
}