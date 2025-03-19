<?php

namespace App\Observers;

use App\Enum\ImportControlStatusEnum;
use App\Events\ImportControlFailureEvent;
use App\Models\ImportControl;

class ImportControlObserver
{
    /**
     * @param ImportControl $importControl
     *
     * @return void
     */
    public function updated(ImportControl $importControl): void
    {
        if ($importControl->wasChanged(
                'status'
            ) && $importControl->status === ImportControlStatusEnum::FAILURE) {
            event(new ImportControlFailureEvent($importControl));
        }
    }
}
