<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserMute;
use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(UserMute::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'mute_user_id' => User::where('id', '!=', 1)->get()->random()->id,
        'expired_at' => rand(0, 1)
            ? Carbon::now()->add(new DateInterval('P1M'))
            : Carbon::now()->sub(new DateInterval('P1M')),
    ];
});
