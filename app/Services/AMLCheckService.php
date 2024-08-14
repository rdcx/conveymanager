<?php

namespace App\Services;

use App\Contracts\AMLChecker;
use App\Models\AmlResult;
use App\Models\Client;

class AMLCheckService implements AMLChecker
{
    /**
     * Perform an AML check.
     *
     * @param mixed $data
     * @return bool
     */
    public function performCheck(Client $client): bool
    {
        // Perform AML checks
        return true;
    }
}
