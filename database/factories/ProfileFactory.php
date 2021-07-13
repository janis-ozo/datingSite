<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Profile::class, function (Faker $faker) {

        $gender = ['Male','Female'];
        $name = $faker->firstName;
    return [
        'name'=>$name,
        'surname'=>$faker->lastName,
        'age'=>rand(18,60),
        'gender'=> $gender[rand(0,1)],
        'location'=>$faker->city,
        'profile_picture'=>'https://fakeimg.pl/350x200/?text='.$name.'&font=lobster'
    ];
});
