<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'status' => ['nullable'],
            'imported_t' => ['date'],
            'url' => ['nullable'],
            'creator' => ['nullable'],
            'created_t' => ['nullable', 'date'],
            'last_modified_t' => ['nullable', 'date'],
            'product_name' => ['nullable'],
            'quantity' => ['nullable'],
            'brands' => ['nullable'],
            'categories' => ['nullable'],
            'labels' => ['nullable'],
            'cities' => ['nullable'],
            'purchase_places' => ['nullable'],
            'stores' => ['nullable'],
            'ingredients_text' => ['nullable'],
            'traces' => ['nullable'],
            'serving_size' => ['nullable'],
            'serving_quantity' => ['nullable', 'numeric'],
            'nutriscore_score' => ['nullable', 'integer'],
            'nutriscore_grade' => ['nullable'],
            'main_category' => ['nullable'],
            'image_url' => ['nullable'],
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
