<?php

namespace App\Models;

use App\Enum\ProductStatusEnum;
use Carbon\Carbon;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property int $code
 * @property string|null $status
 * @property Carbon $imported_t
 * @property string|null $url
 * @property string|null $creator
 * @property Carbon|null $created_t
 * @property Carbon|null $last_modified_t
 * @property string|null $product_name
 * @property string|null $quantity
 * @property string|null $brands
 * @property string|null $categories
 * @property string|null $labels
 * @property string|null $cities
 * @property string|null $purchase_places
 * @property string|null $stores
 * @property string|null $ingredients_text
 * @property string|null $traces
 * @property string|null $serving_size
 * @property float|null $serving_quantity
 * @property int|null $nutriscore_score
 * @property string|null $nutriscore_grade
 * @property string|null $main_category
 * @property string|null $image_url
 */
class Product extends Model
{
    /**
     * @use HasFactory<ProductFactory>
     */
    use HasFactory;

    /**
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var string
     */
    protected $primaryKey = 'code';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'code',
        'status',
        'imported_t',
        'url',
        'creator',
        'created_t',
        'last_modified_t',
        'product_name',
        'quantity',
        'brands',
        'categories',
        'labels',
        'cities',
        'purchase_places',
        'stores',
        'ingredients_text',
        'traces',
        'serving_size',
        'serving_quantity',
        'nutriscore_score',
        'nutriscore_grade',
        'main_category',
        'image_url',
    ];

    /**
     * @var array<string, mixed>
     */
    protected $casts = [
        'imported_t' => 'datetime',
        'created_t' => 'datetime',
        'last_modified_t' => 'datetime',
        'status' => ProductStatusEnum::class,
    ];
}
