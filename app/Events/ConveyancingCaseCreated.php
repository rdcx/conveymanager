<?php

namespace App\Events;

use App\Models\ConveyancingCase;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConveyancingCaseCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * Create a new event instance.
     */
    public function __construct(
        public ConveyancingCase $conveyancingCase
    ) {
    }
}
