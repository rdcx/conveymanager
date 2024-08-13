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
    public function index()
    {
        // Assuming the authenticated user should see their own stats
        $user = Auth::user();

        // Example statistics
        $totalProperties = Property::where('owner_id', $user->id)->count();
        $totalConveyancingCases = ConveyancingCase::where('conveyancer_id', $user->id)->count();
        $totalUsers = User::count(); // Example: Show total users in the system (for admin)

        return Inertia::render('Dashboard', [
            'totalProperties' => $totalProperties,
            'totalConveyancingCases' => $totalConveyancingCases,
            'totalUsers' => $totalUsers,
        ]);
    }
}