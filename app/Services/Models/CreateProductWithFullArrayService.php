<?php

namespace App\Services\Models;

use App\Models\Product;
use App\Services\Service;

class CreateProductWithFullArrayService implements Service
{
    /**
     * @param array $product
     */
    public function __construct(
        private readonly array $product
    ) {
    }

    /**
     * @return Product
     */
    public function __invoke(): Product
    {
        return Product::create($this->product);
    }
}