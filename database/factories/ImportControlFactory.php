<?php

namespace Database\Factories;

use App\Enum\ImportControlStatusEnum;
use App\Models\ImportControl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ImportControl>
 */
class ImportControlFactory extends Factory
{
    use WithoutModelEvents;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'url' => $this->faker->url(),
            'status' => $this->faker->randomElement(ImportControlStatusEnum::itens()),
            'description' => $this->faker->realText(),
        ];
    }
}
