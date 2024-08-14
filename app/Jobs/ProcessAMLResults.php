<?php

namespace App\Jobs;

use App\Models\ConveyancingCase;
use App\Models\Task;
use App\Notifications\AMLChecksCompleteNotification;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessAMLResults implements ShouldQueue
{
    use Queueable, Batchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public ConveyancingCase $conveyancingCase,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->conveyancingCase->conveyancer->notify(new AMLChecksCompleteNotification($this->conveyancingCase));
        // Check if any clients have a failed AML check result
        $amlSuccessCount = $this->conveyancingCase->amlResults()
            ->where('success', true)
            ->count();
        $totalCaseClients = $this->conveyancingCase->clients()->count();

        // Check if all clients have passed the AML checks
        if ($amlSuccessCount === $totalCaseClients) {
            // Close the AML checks task
            $this->conveyancingCase->tasks()->where('name', Task::PERFORM_AML_CHECKS)->update([
                'is_completed' => true,
            ]);
            $this->conveyancingCase->tasks()->create([
                'name' => 'Follow up with the client',
                'due_date' => now()->addDays(1),
            ]);
            return;
        }

        // If there are failed AML checks, create a new task for the conveyancer
        // to follow up with the client and create a new task for the client to
        // provide additional information
        $this->conveyancingCase->tasks()->create([
            'name' => 'AML checks failed, follow up with the client',
            'due_date' => now()->addDays(1),
        ]);
    }
}
