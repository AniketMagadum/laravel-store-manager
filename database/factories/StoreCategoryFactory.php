<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\StoreCategory;
use Faker\Generator as Faker;

$factory->define(StoreCategory::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'description'=>$faker->text($maxNbChars = 200),
    ];
});
