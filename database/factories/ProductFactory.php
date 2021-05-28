<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductModel;
use Faker\Generator as Faker;

$factory->define(ProductModel::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'description' => $faker->sentence(),
        'price' => 2000,
        'qtd' => rand(1, 10),
        'categorie' => rand(1, 5)
    ];
});
