<?php

namespace App\Http\Controllers;

use App\Events\ConveyancingCaseCreated;
use App\Http\Requests\StoreConveyancingCaseRequest;
use App\Models\Client;
use App\Models\ConveyancingCase;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ConveyancingCaseController extends Controller
{

    /**
     * Display a listing of the conveyancing cases.
     */
    public function index(): \Inertia\Response
    {
        Gate::authorize('index', ConveyancingCase::class);

        $cases = ConveyancingCase::with('property', 'conveyancer', 'clients')->get();

        return Inertia::render('ConveyancingCase/Index', [
            'cases' => $cases,
        ]);
    }

    /**
     * Show the form for editing the specified conveyancing case.
     */
    public function edit(ConveyancingCase $conveyancingCase): \Inertia\Response
    {
        Gate::authorize('edit', $conveyancingCase);

        $properties = Property::all();
        $clients = Client::all();
        $convencers = User::where('role', 'conveyancer')->get();

        return Inertia::render('ConveyancingCase/Edit', [
            'conveyancingCase' => $conveyancingCase->load('property', 'conveyancer', 'clients', 'tasks'),
            'properties' => $properties,
            'clients' => $clients,
            'convencers' => $convencers,
        ]);
    }


    /**
     * Show the form for creating a new conveyancing case.
     */
    public function create(Property $property): \Inertia\Response
    {
        Gate::authorize('create', ConveyancingCase::class);

        $conveyancers = User::where('role', 'conveyancer')->get();
        $clients = Client::select(['id', 'first_name', 'last_name'])->get();

        return Inertia::render('ConveyancingCase/Create', [
            'property' => $property,
            'conveyancers' => $conveyancers,
            'clients' => $clients,
        ]);
    }

    /**
     * Store a newly created conveyancing case in the database.
     */
    public function store(StoreConveyancingCaseRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Create a new conveyancing case with validated data
        $case = ConveyancingCase::create($request->validated());
        // Attach the client to the conveyancing case
        $case->clients()->attach($request->client_id, ['is_lead' => true]);

        ConveyancingCaseCreated::dispatch($case);
        return redirect()->route('properties.index')->with('success', 'Conveyancing case created successfully.');
    }
}
