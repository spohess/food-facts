<?php

namespace App\Services\Models;

use App\Enum\ProductStatusEnum;
use App\Models\Product;
use App\Services\Service;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllProductsWithPaginateService implements Service
{
    /**
     * @return LengthAwarePaginator
     */
    public function __invoke(): LengthAwarePaginator
    {
        return Product::where('status', '=', ProductStatusEnum::PUBLISHED->value)->paginate(20);
    }
}