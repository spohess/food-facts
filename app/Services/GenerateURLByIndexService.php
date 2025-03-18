<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class GenerateURLByIndexService implements Service
{
    private array $indexes;

    private array $urlsData = [];

    /**
     * @return array
     * @throws ConnectionException
     */
    public function __invoke(): array
    {
        $this->loadIndexes();
        $this->generateURLData();

        return $this->urlsData;
    }

    /**
     * @throws ConnectionException
     */
    private function loadIndexes(): void
    {
        $response = Http::get(config('openfoodfacts.urls.index'));
        if (! $response->successful()) {
            throw new ConnectionException(
                "Falha ao ler os índices. Status: {$response->status()}"
            );
        }

        $content = trim($response->body());
        $this->indexes = array_filter(
            explode("\n", $content),
            fn($line) => ! empty(trim($line))
        );
    }

    /**
     * @return void
     */
    private function generateURLData(): void
    {
        $this->urlsData = array_map(
            fn($index) => config('openfoodfacts.urls.data') . trim($index),
            $this->indexes
        );
    }
}
