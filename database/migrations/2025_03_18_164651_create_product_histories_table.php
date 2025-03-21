<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        Schema::create('product_histories', function (Blueprint $collection) {
            $collection->index('code');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::drop('product_histories');
    }
};
