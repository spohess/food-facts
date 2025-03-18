<?php

namespace App\Console\Commands;

use App\Services\ETLProductsService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Client\ConnectionException;

class ETLProductsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'etl:import-producst';

    /**
     * @var string
     */
    protected $description = 'Command executar o ETL de produtos';

    /**
     * @return void
     *
     * @throws BindingResolutionException
     * @throws ConnectionException
     */
    public function handle(): void
    {
        app()->make(ETLProductsService::class)();
    }
}
