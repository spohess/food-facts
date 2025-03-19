<?php

namespace App\Services\Models;

use App\Models\User;
use App\Services\Service;

class FindSystemAdministratorService implements Service
{
    /**
     * @return User|null
     */
    public function __invoke(): User | null
    {
        return User::whereAdmin(true)->first();
    }
}