<?php

namespace App\Services\Models;

use App\Enum\ProductStatusEnum;
use App\Models\Product;
use App\Services\Service;

class DeleteProductService implements Service
{
    /**
     * @param Product $productModel
     */
    public function __construct(
        private Product $productModel
    ) {
    }

    /**
     * @return Product
     */
    public function __invoke(): Product
    {
        $this->productModel->status = ProductStatusEnum::TRASH->value;
        $this->productModel->save();

        return $this->productModel;
    }
}
