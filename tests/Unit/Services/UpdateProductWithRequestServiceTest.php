<?php

namespace Tests\Unit\Services;

use App\Models\Product;
use App\Services\Models\UpdateProductWithRequestService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProductWithRequestServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws BindingResolutionException
     */
    public function testUpdatesProductWithRequestData(): void
    {
        $product = Product::factory()->create([
            'brands' => 'Original Brand',
            'creator' => 'Original Creator',
        ]);

        $updateData = [
            'brands' => 'Atualizado Brand',
            'creator' => 'Atualizado Creator',
        ];

        $updatedProduct = app()->make(UpdateProductWithRequestService::class, [
            'productModel' => $product,
            'product' => $updateData,
        ])();

        $this->assertEquals($updateData['brands'], $updatedProduct->brands);
        $this->assertEquals($updateData['creator'], $updatedProduct->creator);
    }

    /**
     * @return void
     *
     * @throws BindingResolutionException
     */
    public function testReturnsUpdatedProductModel(): void
    {
        $product = Product::factory()->create();
        $updateData = [
            'brands' => 'Brand',
        ];

        $updatedProduct = app()->make(UpdateProductWithRequestService::class, [
            'productModel' => $product,
            'product' => $updateData,
        ])();

        $this->assertInstanceOf(Product::class, $updatedProduct);
        $this->assertEquals($product->code, $updatedProduct->code);
        $this->assertEquals('Brand', $updatedProduct->brands);
    }

    /**
     * @return void
     *
     * @throws BindingResolutionException
     */
    public function testHandlesEmptyUpdateData(): void
    {
        Product::factory()->create();

        $this->expectException(BindingResolutionException::class);
        app()->make(UpdateProductWithRequestService::class)();
    }
}
