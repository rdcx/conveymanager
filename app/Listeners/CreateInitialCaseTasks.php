<?php

namespace App\Listeners;

use App\Events\ConveyancingCaseCreated;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateInitialCaseTasks implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ConveyancingCaseCreated  $event
     * @return void
     */
    public function handle(ConveyancingCaseCreated $event)
    {
        $event->conveyancingCase->tasks()->create([
            'name' => Task::PERFORM_AML_CHECKS,
            'due_date' => now()->addDays(1),
        ]);
    }
}