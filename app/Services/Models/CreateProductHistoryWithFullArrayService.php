<?php

namespace App\Services\Models;

use App\Models\ProductHistory;
use App\Services\Service;

class CreateProductHistoryWithFullArrayService implements Service
{
    /**
     * @param array $product
     */
    public function __construct(
        private readonly array $product
    ) {
    }

    /**
     * @return void
     */
    public function __invoke(): void
    {
        ProductHistory::insert($this->product);
    }
}