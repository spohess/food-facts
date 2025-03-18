<?php

namespace App\Traits;

trait EnumTools
{
    /**
     * @return array
     */
    public static function itens(): array
    {
        return array_column(self::cases(), 'value');
    }
}
