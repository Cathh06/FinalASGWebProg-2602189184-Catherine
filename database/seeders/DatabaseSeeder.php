<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('en_EN');


        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'hobby' => implode(', ', $faker->randomElements([
                    'Sport',
                    'Art and Crafts',
                    'Music',
                    'Photography',
                    'Reading',
                    'Cooking',
                    'Games',
                    'Gardening',
                    'Adventure',
                    'Collecting'
                ], 3)),
                'username_ig' => 'http://www.instagram.com/' . $faker->userName,
                'phonenumber' => $faker->phoneNumber,
                'has_paid' => 1,
                'register_price' => rand(100000, 125000),
                'profile' => 'profile_dummy/' . $faker->numberBetween(1, 3) . '.jpeg',
            ]);

        }


    }
}
