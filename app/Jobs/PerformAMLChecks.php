<?php

namespace App\Jobs;

use App\Models\AMLResult;
use App\Models\Client;
use App\Models\ConveyancingCase;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PerformAMLChecks implements ShouldQueue
{
    use Queueable, Batchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public ConveyancingCase $conveyancingCase,
        public Client $client,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(
        \App\Contracts\AMLChecker $amlChecker,
    ) {
        // Perform AML checks
        $result = $amlChecker->performCheck($this->client);
        // Store the result
        AMLResult::create([
            'success' => $result,
            'conveyancing_case_id' => $this->conveyancingCase->id,
            'client_id' => $this->client->id,
        ]);
    }
}
