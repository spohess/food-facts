<?php

namespace App\Services\Models;

use App\Models\Product;
use App\Services\Service;

class FindProductByCodeService implements Service
{
    public function __construct(
        private readonly string $code
    ) {
    }

    /**
     * @return Product|null
     */
    public function __invoke(): Product | null
    {
        return Product::where('code', '=', (int)$this->code)->first();
    }
}