<?php

$factory->defineAs(App\User::class, 'user', function (Faker\Generator $faker) {
	return [
		'role' => 'user',
		'name' => $faker->name,
		'email' => $faker->safeEmail,
		'password' => bcrypt(str_random(10)),
		'remember_token' => str_random(10),
	];
});

$factory->defineAs(App\User::class, 'admin', function (Faker\Generator $faker) use ($factory) {
	return $factory->raw(App\User::class, [
		'role' => 'admin'
	], 'user');
});

$factory->defineAs(App\User::class, 'superadmin', function (Faker\Generator $faker) use ($factory) {
	return $factory->raw(App\User::class, [
		'role' => 'superadmin'
	], 'user');
});
