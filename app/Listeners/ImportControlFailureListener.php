<?php

namespace App\Listeners;

use App\Events\ImportControlFailureEvent;
use App\Notifications\ImportFailureNotification;
use App\Services\Models\FindSystemAdministratorService;
use Illuminate\Contracts\Container\BindingResolutionException;

class ImportControlFailureListener
{
    /**
     * @throws BindingResolutionException
     */
    public function handle(ImportControlFailureEvent $event): void
    {
        $user = app()->make(FindSystemAdministratorService::class)();
        if (! $user) {
            return;
        }

        $user->notify(new ImportFailureNotification($event->importControl));
    }
}
