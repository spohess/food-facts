<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration {
    /**
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $collection) {
            $collection->index('code');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::drop('products');
    }
};
