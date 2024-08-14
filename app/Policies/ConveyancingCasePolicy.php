<?php

namespace App\Policies;

use App\Models\ConveyancingCase;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConveyancingCasePolicy
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
     * Determine whether the user can view the model.
     */
    public function view(User $user, ConveyancingCase $conveyancingCase): Response
    {
        return $user->id === $conveyancingCase->conveyancer()->is($user)
            ? Response::allow()
            : Response::deny('You do not have access to this case.');
    }

    /**
     * Determine whether the user can edit the model.
     */
    public function edit(User $user, ConveyancingCase $case): Response
    {
        if ($user->role == 'conveyancer' && $case->conveyancer()->is($user)) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit cases.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ConveyancingCase $conveyancingCase): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }

        return $user->id === $conveyancingCase->conveyancer()->is($user)
            ? Response::allow()
            : Response::deny('You do not have permission to update this case.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if ($user->role === 'conveyancer') {
            return Response::allow();
        }

        return Response::deny('You do not have permission to create cases.');
    }

    /**
     * Determine whether the user can store the model.
     */
    public function store(User $user): Response
    {
        if ($user->role === 'conveyancer') {
            return Response::allow();
        }

        return Response::deny('You do not have permission to store cases.');
    }
}
