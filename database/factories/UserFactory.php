<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->name,
    ];
});

$factory->state(
    Post::class,
    'withPosts',
    function ($faker) {
        return [];
    }
);

$factory->afterCreatingState(
    User::class,
    'withPosts',
    /** @var User $user */
    function ($user) {
        \factory(Post::class, 10)->create(['user_id' => $user->id]);
    }
);
