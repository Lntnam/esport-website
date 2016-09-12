<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    static $password;
//
//    return [
//        'name' => $faker->name,
//        'email' => $faker->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
//        'remember_token' => str_random(10),
//    ];
//});

$factory->define(App\Models\Opponent::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->company.' '.$faker->companySuffix;

    return [
        'name'    => $name,
        'short'   => getFirstLetters($name),
        'country' => $faker->country,
        'flag'    => $faker->imageUrl($width = 64, $height = 64, 'sports'),
    ];
});

$factory->define(App\Models\Tournament::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->sentence(5);

    return [
        'name'     => $name,
        'short'    => getFirstLetters($name),
        'type'     => $faker->randomElements(['online', 'onlan', 'other'], $count = 1)[0],
        'logo'     => $faker->imageUrl($width = 130, $height = 40, 'sports'),
        'homepage' => $faker->url(),
        'bracket'  => $faker->url(),
        'prize'    => $faker->numberBetween(1000, $max = 200000),
    ];
});

$factory->define(App\Models\Match::class, function (Faker\Generator $faker) {
    $for = $faker->numberBetween(0, 3);

    return [
        'schedule'      => $faker->dateTimeBetween('-10 months', \Carbon\Carbon::now()->addDay(30)),
        'tournament_id' => $faker->numberBetween(1, $max = 10),
        'opponent_id'   => $faker->numberBetween(1, $max = 30),
        'for'           => $for,
        'against'       => $faker->numberBetween(0, 5 - $for),
    ];
});

function getFirstLetters($text)
{
    $words = explode(' ', $text);
    $acronym = '';

    foreach ($words as $w) {
        $acronym .= $w[0];
    }

    return strtoupper($acronym);
}
