<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('status_mysql', function (Blueprint $table) {
            $table->id();
            $table->dateTime('last_verification')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('status_mysql');
    }
};
