<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ClassGroup;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Student::insert([
            [
                'name' => 'Fulano da Silva',
                'gender' => 'M',
                'birth_date' => '2013-05-10',
                'class_group_id' => null,
                'user_id' => 1
            ],
            [
                'name' => 'Ciclano Silveira',
                'gender' => 'M',
                'birth_date' => '2013-08-13',
                'class_group_id' => null,
                'user_id' => 1
            ],
            [
                'name' => 'Beltrano de Souza',
                'gender' => 'M',
                'birth_date' => '2013-03-22',
                'class_group_id' => null,
                'user_id' => 1
            ],
            [
                'name' => 'Zutano Pereira',
                'gender' => 'M',
                'birth_date' => '2013-06-07',
                'class_group_id' => null,
                'user_id' => 2
            ],
            [
                'name' => 'Rengano Mesquita',
                'gender' => 'M',
                'birth_date' => '2013-01-26',
                'class_group_id' => null,
                'user_id' => 2
            ],
            [
                'name' => 'Alano Medeiros',
                'gender' => 'M',
                'birth_date' => '2013-09-02',
                'class_group_id' => null,
                'user_id' => 2
            ]
        ]);
    }
}
