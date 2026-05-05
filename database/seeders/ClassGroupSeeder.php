<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ClassGroup;

class ClassGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassGroup::insert([
            ['name' => 'Turma A1', 'description' => 'Manhã', 'user_id' => 1],
            ['name' => 'Turma A1', 'description' => 'Tarde', 'user_id' => 1],
            ['name' => 'Turma B1', 'description' => 'Manhã', 'user_id' => 2],
            ['name' => 'Turma B2', 'description' => 'Tarde', 'user_id' => 2],
        ]);
    }
}
