<?php

namespace App\Services\Models;

use App\Models\Product;
use App\Services\Service;
use Carbon\Carbon;

class UpdateProductWithRequestService implements Service
{
    /**
     * @param Product $productModel
     * @param array $product
     */
    public function __construct(
        private Product $productModel,
        private readonly array $product
    ) {
    }

    /**
     * @return Product
     */
    public function __invoke(): Product
    {
        $this->productModel->update($this->product);

        return $this->productModel;
    }
}
