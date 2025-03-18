<?php

namespace App\Jobs;

use App\Exceptions\DownloadProductFileException;
use App\Exceptions\ETLJobException;
use App\Models\ImportControl;
use App\Services\DownloadProductFilesService;
use App\Services\Models\UpdateImportControlWithErrorService;
use App\Services\Models\UpdateImportControlWithSuccessService;
use App\Services\ReadProductFilesService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ETLProductsJob implements ShouldQueue
{
    use Queueable;

    /**
     * @param ImportControl $importControl
     */
    public function __construct(
        private ImportControl $importControl
    ) {
    }

    /**
     * @return void
     *
     * @throws BindingResolutionException
     * @throws ETLJobException
     */
    public function handle(): void
    {
        try {
            $filePath = app()->make(DownloadProductFilesService::class, ['url' => $this->importControl->url])();
        } catch (DownloadProductFileException $e) {
            app()->make(UpdateImportControlWithErrorService::class, [
                'importControl' => $this->importControl,
                'description' => $e->getMessage(),
            ])();

            throw new ETLJobException('Erro no download ou arquivamento: ' . $e->getMessage());
        }

        try {
            app()->make(ReadProductFilesService::class, [
                'filePath' => $filePath,
            ])();
        } catch (Exception $e) {
            app()->make(UpdateImportControlWithErrorService::class, [
                'importControl' => $this->importControl,
                'description' => $e->getMessage(),
            ])();
        }

        app()->make(UpdateImportControlWithSuccessService::class, [
            'importControl' => $this->importControl,
            'description' => 'Processo de download e leitura do arquivo finalizada',
        ])();
    }
}
