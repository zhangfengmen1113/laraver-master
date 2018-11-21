<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence(),
        'user_id'=>mt_rand(1,10),
        'category_id'=>mt_rand(1,6),
        //这个800不懂
        'content'=>$faker->text($maxNbChars=800)
    ];
});
