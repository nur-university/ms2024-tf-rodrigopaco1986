<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Routes to simulate integration with other micro services
Route::prefix('fake')->group(function () {
    Route::get('/patient/{id}', function (string $id) {

        $faker = Faker\Factory::create();

        return response()->json([
            'id' => $id,
            'code' => $faker->randomNumber(5),
            'name' => $faker->name(),
            'nit' => $faker->randomNumber(7),
            'address' => $faker->address(),
            'phone' => $faker->phoneNumber(),
            'email' => $faker->email(),
        ]);
    });

    Route::get('/service/{id}', function (string $id) {

        $faker = Faker\Factory::create();

        return response()->json([
            'id' => $id,
            'code' => $faker->randomNumber(5),
            'name' => $faker->sentence(4),
            'unit' => $faker->word(),
            'description' => $faker->sentence(10),
        ]);
    });
});
