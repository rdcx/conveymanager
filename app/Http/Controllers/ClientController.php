<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Show the form for creating a new Client.
     */
    public function create() : \Inertia\Response
    {
        Gate::authorize('create', Client::class);

        return Inertia::render('Client/Create');
    }

    /**
     * Store a newly created Client in the database.
     */
    public function store(StoreClientRequest $request): \Illuminate\Http\RedirectResponse
    {
        Client::create($request->validated());

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    /**
     * Display a listing of the properties.
     */
    public function index() : \Inertia\Response
    {
        Gate::authorize('index', Client::class);

        $clients = Client::get();

        return Inertia::render('Client/Index', [
            'clients' => $clients,
        ]);
    }
}