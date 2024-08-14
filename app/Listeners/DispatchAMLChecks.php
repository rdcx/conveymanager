<?php

namespace App\Listeners;

use App\Events\ConveyancingCaseCreated;
use App\Jobs\PerformAMLChecks;
use App\Jobs\ProcessAMLResults;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Contracts\Queue\ShouldQueue;

class DispatchAMLChecks implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ConveyancingCaseCreated  $event
     * @return void
     */
    public function handle(ConveyancingCaseCreated $event)
    {
        $amlCheckJobs = collect();   

        // Perform AML checks for each client within the conveyancing case
        $event->conveyancingCase->clients()->each(
            fn($client) => $amlCheckJobs->push(new PerformAMLChecks($event->conveyancingCase, $client))
        );

        // Process the AML check results
        $amlCheckJobs->push(new ProcessAMLResults($event->conveyancingCase));

        // Dispatch the batch and then process the results
        Bus::batch($amlCheckJobs)->dispatch();
    }
}