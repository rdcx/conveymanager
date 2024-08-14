<?php

namespace App\Contracts;

use App\Models\Client;

interface AMLChecker 
{
    /**
     * Perform an AML check.
     *
     * @param mixed $data
     * @return bool
     */
    public function performCheck(Client $client): bool;
}