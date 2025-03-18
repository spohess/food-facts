<?php

namespace App\Models;

use App\Enum\ImportControlStatusEnum;
use Carbon\Carbon;
use Database\Factories\ImportControlFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $uuid
 * @property string $url
 * @property string $status
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ImportControl extends Model
{
    /**
     * @use HasFactory<ImportControlFactory>
     */
    use HasFactory;

    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var string
     */
    protected $table = 'import_controls';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'uuid',
        'url',
        'status',
        'description',
    ];

    /**
     * @var array<string, mixed>
     */
    protected $casts = [
        'status' => ImportControlStatusEnum::class,
    ];
}
