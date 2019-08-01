<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'description'=>$faker->text($maxNbChars = 200),
        'store_category_id'=>factory('App\StoreCategory')->create()->id,
        'address'=>$faker->address,
        'is_published'=>$faker->boolean($chanceOfGettingTrue = 50)
    ];
});
