<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Post
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Post extends Model
{
    protected $table = 'post';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
