<?php

namespace Tests\Unit\Services;

use App\Models\Product;
use App\Services\Models\FindProductByCodeService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FindProductByCodeServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     *
     * @throws BindingResolutionException
     */
    public function testCanFindProductByCode(): void
    {
        $code = '12345';
        $product = Product::factory()->create(['code' => (int)$code]);

        $foundProduct = app()->make(FindProductByCodeService::class, [
            'code' => $code,
        ])();

        $this->assertInstanceOf(Product::class, $foundProduct);
        $this->assertEquals($product->code, $foundProduct->code);
        $this->assertEquals((int)$code, $foundProduct->code);
    }

    /**
     * @return void
     *
     * @throws BindingResolutionException
     */
    public function testReturnsNullWhenProductNotFound(): void
    {
        $code = '99999';
        $this->assertNull(Product::where('code', '=', (int)$code)->first());

        $foundProduct = app()->make(FindProductByCodeService::class, [
            'code' => $code,
        ])();

        $this->assertNull($foundProduct);
    }
}
