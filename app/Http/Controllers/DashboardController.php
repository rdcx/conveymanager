<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Models\ConveyancingCase;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Show the dashboard with statistics.
     */
    public function index() : \Inertia\Response
    {
        $totalProperties = Property::count();
        $totalConveyancingCases = ConveyancingCase::count();
        $totalUsers = User::count();

        return Inertia::render('Dashboard', [
            'totalProperties' => $totalProperties,
            'totalConveyancingCases' => $totalConveyancingCases,
            'totalUsers' => $totalUsers,
        ]);
    }
}