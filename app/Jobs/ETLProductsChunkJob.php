<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ETLProductsChunkJob implements ShouldQueue
{
    use Queueable;

    /**
     * @param array $chunk
     */
    public function __construct(
        private array $chunk,
    ) {
    }

    /**
     * @return void
     */
    public function handle(): void
    {
    }
}
