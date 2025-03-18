<?php

namespace App\Services;

use App\Exceptions\DownloadProductFileConnectException;
use App\Exceptions\DownloadProductFileStoreException;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DownloadProductFilesService implements Service
{
    /**
     * @param string $url
     * @param string $filePath
     */
    public function __construct(
        private readonly string $url,
        private string $filePath
    ) {
        $this->filePath = 'downloads/' . date('YmdHis') . '.json.gz';
    }

    /**
     * @return string
     *
     * @throws DownloadProductFileConnectException
     * @throws DownloadProductFileStoreException
     */
    public function __invoke(): string
    {
        try {
            $response = Http::retry(3, 1000)->get($this->url);

            if (! $response->successful()) {
                throw new Exception();
            }
        } catch (Exception) {
            throw new DownloadProductFileConnectException('Erro ao efetuar download do arquivo ' . $this->url, 500);
        }

        try {
            $this->storesFile($response);
        } catch (Exception $e) {
            throw new DownloadProductFileStoreException('Erro ao salvar o arquivo: ' . $e->getMessage(), 500);
        }

        return $this->filePath;
    }

    /**
     * @param Response $response
     *
     * @return void
     */
    private function storesFile(Response $response): void
    {
        Storage::put($this->filePath, $response->body());
    }
}