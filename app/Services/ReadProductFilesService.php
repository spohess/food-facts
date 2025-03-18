<?php

namespace App\Services;

use App\Exceptions\ReadProductFilesOpenException;
use App\Jobs\ETLProductsChunkJob;
use Illuminate\Support\Facades\Storage;

class ReadProductFilesService implements Service
{
    /**
     * @param string $filePath
     */
    public function __construct(
        private readonly string $filePath
    ) {
    }

    /**
     * @throws ReadProductFilesOpenException
     */
    public function __invoke(): void
    {
        $fullPath = Storage::path($this->filePath);
        $resource = gzopen($fullPath, 'rb');

        if (! $resource) {
            throw new ReadProductFilesOpenException('Não foi possível abrir o arquivo: ' . $fullPath);
        }

        $this->processesContent($resource);
        gzclose($resource);
    }

    private function processesContent(mixed $resource): void
    {
        $chunk = [];
        $chunkSize = (int)config('openfoodfacts.files.chunk.size');
        $chunkLimit = (int)config('openfoodfacts.files.chunk.limit');

        $countChunk = 0;
        $exitByBreak = false;
        while (! gzeof($resource)) {
            if ($chunkLimit !== 0 && $countChunk >= $chunkLimit) {
                $exitByBreak = true;
                break;
            }

            $data = json_decode(trim(gzgets($resource)), true);
            if (! $data) {
                continue;
            }
            $chunk[] = $data;
            if (count($chunk) >= $chunkSize) {
                ETLProductsChunkJob::dispatch($chunk);
                $chunk = [];
                $countChunk++;
            }
        }

        if (!$exitByBreak && count($chunk) > 0) {
            ETLProductsChunkJob::dispatch($chunk);
        }
    }
}