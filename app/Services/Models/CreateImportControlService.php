<?php

namespace App\Services\Models;

use App\Enum\ImportControlStatusEnum;
use App\Models\ImportControl;
use App\Services\Service;
use Illuminate\Support\Str;

class CreateImportControlService implements Service
{
    /**
     * @param string $url
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * @return ImportControl
     */
    public function __invoke(): ImportControl
    {
        return ImportControl::create([
            'uuid' => Str::uuid(),
            'url' => $this->url,
            'status' => ImportControlStatusEnum::PROCESSING->value,
        ]);
    }
}