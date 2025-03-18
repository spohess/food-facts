<?php

namespace App\Services;

use App\Jobs\ETLProductsJob;
use App\Services\Models\CreateImportControlService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Client\ConnectionException;

class ETLProductsService implements Service
{
    /**
     * @param GenerateURLByIndexService $urls
     */
    public function __construct(
        private readonly GenerateURLByIndexService $urls
    ) {
    }

    /**
     * @return void
     *
     * @throws ConnectionException
     * @throws BindingResolutionException
     */
    public function __invoke(): void
    {
        foreach (($this->urls)() as $url) {
            $importControl = app()->make(CreateImportControlService::class, [
                'url' => $url,
            ])();
            ETLProductsJob::dispatch($importControl);
        }
    }
}
