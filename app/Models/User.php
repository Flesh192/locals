<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class User
 * @package App\Models
 * @property int $id
 * @property string $username
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Model
{
    protected $table = 'user';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
