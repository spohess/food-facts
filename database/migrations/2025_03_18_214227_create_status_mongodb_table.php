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
        Schema::create('status_mongodb', function (Blueprint $collection) {
            $collection->id();
            $collection->dateTime('last_verification')
                ->nullable();
            $collection->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('status_mongodb');
    }
};
