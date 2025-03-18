<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ProductHistory extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * @var string
     */
    protected $table = 'product_histories';
}
