<?php

namespace App\Services\Models;

use App\Models\ImportControl;
use App\Services\Service;

class GetLastImportControlService implements Service
{
    /**
     * @return ImportControl|null
     */
    public function __invoke(): ImportControl|null
    {
        return ImportControl::latest()->first();
    }
}