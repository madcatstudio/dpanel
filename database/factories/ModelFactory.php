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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Carbon\Carbon;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Domain::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->domainName,
        'registration_date' => Carbon::now()->toDateTimeString(),
        'ip' => $faker->ipv4,
        'hosting_id' => function () {
            return factory(App\Hosting::class)->create()->id;
        },
        'maintainer_id' => function () {
            return factory(App\Maintainer::class)->create()->id;
        },
    ];
});

$factory->define(App\Hosting::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->domainWord,
        'username' => $faker->userName,
        'password' => $faker->password,
        'website' => $faker->url,
        'details' => $faker->paragraph,
    ];
});

$factory->define(App\Maintainer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->domainWord,
        'username' => $faker->userName,
        'password' => $faker->password,
        'website' => $faker->url,
        'details' => $faker->paragraph,
    ];
});

$factory->define(App\Email::class, function (Faker\Generator $faker) {
    return [
        'domain_id' => function () {
            return factory(App\Domain::class)->create()->id;
        },
        'name' => $faker->word,
        'password' => $faker->password,
    ];
});

$factory->define(App\Database::class, function (Faker\Generator $faker) {
    return [
        'domain_id' => function () {
            return factory(App\Domain::class)->create()->id;
        },
        'name' => $faker->domainWord,
        'username' => $faker->userName,
        'password' => $faker->password,
    ];
});

$factory->define(App\Subdomain::class, function (Faker\Generator $faker) {
    return [
        'domain_id' => function () {
            return factory(App\Domain::class)->create()->id;
        },
        'name' => $faker->word,
    ];
});

$factory->define(App\WebApp::class, function (Faker\Generator $faker) {
    return [
        'domain_id' => function () {
            return factory(App\Domain::class)->create()->id;
        },
        'name' => $faker->word,
        'username' => $faker->userName,
        'password' => $faker->password,
        'details' => $faker->paragraph,
    ];
});