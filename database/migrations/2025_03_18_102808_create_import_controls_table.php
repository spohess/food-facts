<?php

use App\Enum\ImportControlStatusEnum;
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
        Schema::create('import_controls', function (Blueprint $table) {
            $table->id();
            $table->uuid()
                ->index();
            $table->string('url');
            $table->enum('status', ImportControlStatusEnum::itens())
                ->default(ImportControlStatusEnum::PROCESSING->value);
            $table->text('description')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('import_controls');
    }
};
