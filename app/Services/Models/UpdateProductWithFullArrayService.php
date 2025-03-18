<?php

namespace App\Services\Models;

use App\Models\Product;
use App\Services\Service;
use Carbon\Carbon;

class UpdateProductWithFullArrayService implements Service
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
        if (Carbon::createFromTimestamp($this->product['last_modified_t'])->gt($this->productModel->last_modified_t)) {
            $this->productModel->update($this->product);
        }

        return $this->productModel;
    }
}
