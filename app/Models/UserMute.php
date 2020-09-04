<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserMute
 * @package App\Models
 * @property $user_id
 * @property $mute_user_id
 * @property Carbon $expired_at
 */
class UserMute extends Model
{
    protected $table = 'user_mute';

    public $timestamps = false;

    protected $guarded = [];

    protected $dates = [
        'expired_at',
    ];
}
