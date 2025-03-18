<?php

namespace App\Enum;

use App\Traits\EnumTools;

enum ImportControlStatusEnum: string
{
    use EnumTools;

    case SUCCESS = 'success';
    case FAILURE = 'failure';
    case PROCESSING = 'processing';
}
