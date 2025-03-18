<?php

namespace App\Enum;

use App\Traits\EnumTools;

enum ProductStatusEnum: string
{
    use EnumTools;

    case DRAFT = 'draft';
    case TRASH = 'trash';
    case PUBLISHED = 'published';
}
