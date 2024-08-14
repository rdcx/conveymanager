<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PropertyPolicy
{

    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user): ?bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function index(User $user): Response
    {
        return  $user->role === 'conveyancer'
            ? Response::allow()
            : Response::deny('You do not have permission to view properties.'); 
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Property $property): Response
    {
        if ($user->role === 'conveyancer') {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this property.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response 
    {
        if ($user->role === 'conveyancer') {
            return Response::allow();
        }

        return Response::deny('You do not have permission to create properties.');
    }

    /**
     * Determine whether the user can store the model.
     */
    public function store(User $user): Response
    {
        if ($user->role === 'conveyancer') {
            return Response::allow();
        }

        return Response::deny('You do not have permission to store properties.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Property $property): Response 
    {
        if ($user->role === 'conveyancer') {
            return Response::allow();
        } 

        return Response::deny('You do not have permission to update this property.');
    }
}