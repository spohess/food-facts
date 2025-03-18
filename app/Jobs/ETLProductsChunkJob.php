<?php

namespace App\Jobs;

use App\Services\Models\CreateProductWithFullArrayService;
use App\Services\Models\FindProductByCodeService;
use App\Services\Models\UpdateProductWithFullArrayService;
use Illuminate\Contracts\Container\BindingResolutionException;
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
     *
     * @throws BindingResolutionException
     */
    public function handle(): void
    {
        foreach ($this->chunk as $product) {
            $productModel = app()->make(FindProductByCodeService::class, [
                'code' => $product['code'],
            ])();

            if ($productModel) {
                app()->make(UpdateProductWithFullArrayService::class, [
                    'productModel' => $productModel,
                    'product' => $product,
                ])();

                return;
            }

            app()->make(CreateProductWithFullArrayService::class, [
                'product' => $product,
            ])();
        }
    }
}
