<?php

use Faker\Generator as Faker;
use App\User;
use App\Post;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->word,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    $userIds = User::all()->pluck('id')->toArray();
    return [
        'user_id' => rand(1,20),
        'title' => $faker->word,
        'content' => $faker->paragraph(5),
        'cover_image' => 'noimage.png',
    ];
});

$factory->define(App\Comment::class, function (Faker $faker) {
    $userIds = User::all()->pluck('id')->toArray();
    return [
        'user_id' => rand(1,20),
        'body' => $faker->word,
        'post_id' => rand(1,100),
    ];
});

