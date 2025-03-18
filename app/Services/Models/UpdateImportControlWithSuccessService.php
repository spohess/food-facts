<?php

namespace App\Services\Models;

use App\Enum\ImportControlStatusEnum;
use App\Models\ImportControl;
use App\Services\Service;

class UpdateImportControlWithSuccessService implements Service
{
    /**
     * @param ImportControl $importControl
     * @param string $description
     */
    public function __construct(
        private ImportControl $importControl,
        private readonly string $description
    ) {
    }

    /**
     * @return void
     */
    public function __invoke(): void
    {
        $this->importControl->status = ImportControlStatusEnum::SUCCESS->value;
        $this->importControl->description = $this->description;
        $this->importControl->save();
    }
}
