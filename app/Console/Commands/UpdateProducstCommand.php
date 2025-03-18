<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateProducstCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:update-producst';

    /**
     * @var string
     */
    protected $description = 'Command para atualizar os produtos disponibilizados no Open Food Facts';

    /**
     * @return void
     */
    public function handle()
    {
    }
}
