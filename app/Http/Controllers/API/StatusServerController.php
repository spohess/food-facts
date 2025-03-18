<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Models\CheckStatusMongodbService;
use App\Services\Models\CheckStatusMysqlService;
use App\Services\Models\GetLastImportControlService;
use Illuminate\Contracts\Container\BindingResolutionException;

class StatusServerController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function __invoke()
    {
        $statusMysql = app()->make(CheckStatusMysqlService::class)();
        $statusMongodb = app()->make(CheckStatusMongodbService::class)();
        $importControl = app()->make(GetLastImportControlService::class)();

        return response()->json([
            'status_mysql' => $statusMysql,
            'status_mongodb' => $statusMongodb,
            'last_import' => $importControl?->created_at->toDateTimeString(),
            'uptime' => exec('uptime -p'),
            'memory' => exec("free -h | grep 'Mem:' | awk '{print \"Total: \" $2 \" - Used: \" $3}'"),
        ]);
    }
}
