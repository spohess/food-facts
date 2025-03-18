<?php

namespace App\Services\Models;

use App\Models\StatusMongodb;
use App\Services\Service;
use Carbon\Carbon;
use Exception;

class CheckStatusMongodbService implements Service
{
    /**
     * @return bool
     */
    public function __invoke(): bool
    {
        try {
            $statusMongodb = StatusMongodb::where('id', '=', 1)->first();

            if (! $statusMongodb) {
                $statusMongodb = StatusMongodb::create([
                    'id' => 1,
                    'last_verification' => Carbon::now()->toDateTimeString(),
                ]);
            }

            $statusMongodb->last_verification = Carbon::now()->toDateTimeString();
            $statusMongodb->save();

            return true;
        } catch (Exception) {
            return false;
        }
    }
}
