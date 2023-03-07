<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ru_RU');

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make($faker->password()),
            ]);
        }
    }
}

