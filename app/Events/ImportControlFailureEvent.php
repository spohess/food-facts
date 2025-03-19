<?php

namespace App\Events;

use App\Models\ImportControl;
use Illuminate\Foundation\Events\Dispatchable;

class ImportControlFailureEvent
{
    use Dispatchable;

    /**
     * @param ImportControl $importControl
     */
    public function __construct(
        public ImportControl $importControl
    ) {
    }
}
