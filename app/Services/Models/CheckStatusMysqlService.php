<?php

namespace App\Services\Models;

use App\Models\StatusMysql;
use App\Services\Service;
use Carbon\Carbon;
use Exception;

class CheckStatusMysqlService implements Service
{
    /**
     * @return bool
     */
    public function __invoke(): bool
    {
        try {
            $statusMysql = StatusMysql::firstOrCreate([
                'id' => 1,
            ]);
            $statusMysql->last_verification = Carbon::now()->toDateTimeString();
            $statusMysql->save();

            return true;
        } catch (Exception) {
            return false;
        }
    }
}
