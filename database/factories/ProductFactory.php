<?php

namespace Database\Factories;

use App\Enum\ProductStatusEnum;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * @var Product
     */
    protected $model = Product::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->numberBetween(1, 99999999),
            'status' => $this->faker->randomElement(ProductStatusEnum::itens()),
            'imported_t' => $this->faker->dateTime(),
            'url' => $this->faker->url(),
            'creator' => $this->faker->userName(),
            'created_t' => $this->faker->dateTime(),
            'last_modified_t' => $this->faker->dateTime(),
            'product_name' => $this->faker->words(3, true),
            'quantity' => $this->faker->numerify() . 'g',
            'brands' => $this->faker->company(),
            'categories' => $this->faker->words(5),
            'labels' => $this->faker->slug(),
            'cities' => $this->faker->city(),
            'purchase_places' => $this->faker->city() . ',' . $this->faker->country(),
            'stores' => $this->faker->word(),
            'ingredients_text' => $this->faker->words(10),
            'traces' => $this->faker->words(5),
            'serving_size' => $this->faker->numerify() . 'g',
            'serving_quantity' => $this->faker->randomFloat(1, 25, 100),
            'nutriscore_score' => $this->faker->numberBetween(0, 40),
            'nutriscore_grade' => $this->faker->randomElement(['a', 'b', 'c', 'd', 'e', 'f']),
            'main_category' => 'en:' . $this->faker->word(),
            'image_url' => $this->faker->imageUrl(400, 400, 'food'),
        ];
    }
}
