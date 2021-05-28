<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
$factory->define(Client::class, function (Faker $faker) {

    $password = 'Agostinho22';

    return [
        'name' => 'Evandro Cliente',
        'email' => 'evandrosilva.ucan@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make($password),
        'remember_token' => Str::random(10),
    ];
});
