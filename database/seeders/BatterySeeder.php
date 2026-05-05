<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Student;
use App\Models\TestBattery;

class BatterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();

        foreach($students as $student){
            TestBattery::create([
                'student_id' => $student->id,
                'year' => 2023
            ]);
        }
    }
}
