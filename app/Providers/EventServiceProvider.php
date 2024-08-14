<?php

namespace App\Providers;

class EventServiceProvider
{
    /**
     * The event listener mappings for the application.
     */
    protected $listen = [
        'App\Events\ConveyancingCaseCreated' => [
            'App\Listeners\CreateInitialCaseTasks',
            'App\Listeners\DispatchAMLChecks',
        ],
    ];
}
