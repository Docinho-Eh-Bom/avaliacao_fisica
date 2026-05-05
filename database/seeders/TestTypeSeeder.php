<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TestType;

class TestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestType::insert([
            //weight
            ['name' => 'Peso', 'unit' => 'kg', 'calc_type' => 'direct', 'calc_key' => 'weight'],
            //height
            ['name' => 'Altura', 'unit' => 'cm', 'calc_type' => 'direct', 'calc_key' => 'height'],
            //waist
            ['name' => 'Cintura', 'unit' => 'cm', 'calc_type' => 'direct', 'calc_key' => 'waist'],
            //body mass index
            ['name' => 'IMC', 'unit' => 'kg/m2', 'calc_type' => 'derived', 'calc_key' => 'bmi'],
            //waist ratio
            ['name' => 'Razão Cintura Altura', 'unit' => 'rca', 'calc_type' => 'derived', 'calc_key' => 'wtr'],
            //sit and reach
            ['name' => 'Flexibilidade', 'unit' => 'cm', 'calc_type' => 'direct', 'calc_key' => null],
            //abdominals
            ['name' => 'Força Abdominal', 'unit' => 'reps', 'calc_type' => 'direct', 'calc_key' => null],
            //6min run
            ['name' => 'Aptidão Cardiorrespiratória', 'unit' => 'm', 'calc_type' => 'direct', 'calc_key' => null],
            //medicine ball throw
            ['name' => 'Força Membros Superiores', 'unit' => 'cm', 'calc_type' => 'direct', 'calc_key' => null],
            //horizontal jump
            ['name' => 'Força Membros Inferiores', 'unit' => 'cm', 'calc_type' => 'direct', 'calc_key' => null],
            //square run
            ['name' => 'Agilidade', 'unit' => 's', 'calc_type' => 'direct', 'calc_key' => null],
            //20m run
            ['name' => 'Velocidade', 'unit' => 's', 'calc_type' => 'direct', 'calc_key' => null],
        ]);
    }
}
