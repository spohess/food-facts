<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon|null $last_verification
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class StatusMysql extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var string
     */
    protected $table = 'status_mysql';

    /**
     * @var array
     */
    protected $fillable = [
        'last_verification',
    ];

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'last_verification' => 'datetime',
        ];
    }
}
