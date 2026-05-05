<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'User Uno',
                'email' => 'uno@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'User Deux',
                'email' => 'deux@gmail.com',
                'password' => bcrypt('654321')
            ]
        ]);
    }
}
