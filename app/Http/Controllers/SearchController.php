<?php

namespace App\Http\Controllers;

use App\Models\ConveyancingCase;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    /**
     * Search for properties or cases.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function results(Request $request) : \Inertia\Response
    {
        $query = $request->input('query');

        $properties = Property::search($query)->get();
        $conveyancingCases = ConveyancingCase::search($query)->get();

        return Inertia::render('Search/Results', [
            'query' => $query,
            'properties' => $properties,
            'conveyancingCases' => $conveyancingCases->load('clients'),
        ]);
    }
}