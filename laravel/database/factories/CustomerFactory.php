<?php

use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        //'customerNumber' => '',
        'customerName' => $faker->name,
        'contactFirstName' => $faker->name,
        'contactLastName' => $faker->name,
        'phone' => '614 555 5555',
        'addressLine1' => '123 Apple Creek Lane',
        'addressLine2' => '',
        'city' => 'Columbus',
        'state' => 'OH',
        'postalCode' => '12345',
        'country' => 'US',
    ];
});
