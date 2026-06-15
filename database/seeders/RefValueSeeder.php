<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReferenceValue;
use App\Models\TestType;

class RefValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        $this->seedFlexibility();
        $this->seedAbdominal();
        $this->seedCardio();
        $this->seedUpperBody();
        $this->seedLowerBody();
        $this->seedAgility();
        $this->seedSpeed();
        $this->seedBMI();
    }

    private function seedFlexibility(): void{
        $testType = TestType::where('name', 'Flexibilidade')->first();
        $json = base_path('database/json/flexibility.json');
        $this->importJson($json, $testType->id);
    }

    private function seedAbdominal(): void{
        $testType = TestType::where('name', 'Força Abdominal')->first();
        $json = base_path('database/json/abdominal.json');
        $this->importJson($json, $testType->id);
    }

    private function seedCardio(): void{
        $testType = TestType::where('name', 'Aptidão Cardiorrespiratória')->first();
        $json = base_path('database/json/cardio.json');
        $this->importJson($json, $testType->id);
    }

    private function seedUpperBody(): void{
        $testType = TestType::where('name', 'Força Membros Superiores')->first();
        $json = base_path('database/json/upper.json');
        $this->importJson($json, $testType->id);
    }

    private function seedLowerBody(): void{
        $testType = TestType::where('name', 'Força Membros Inferiores')->first();
        $json = base_path('database/json/lower.json');
        $this->importJson($json, $testType->id);
    }

    private function seedAgility(): void{
        $testType = TestType::where('name', 'Agilidade')->first();
        $json = base_path('database/json/agility.json');
        $this->importJson($json, $testType->id);
    }

    private function seedSpeed(): void{
        $testType = TestType::where('name', 'Velocidade')->first();
        $json = base_path('database/json/speed.json');
        $this->importJson($json, $testType->id);
    }

    private function seedBMI(): void{
        $testType = TestType::where('name', 'IMC')->first();
        $json = base_path('database/json/bmi.json');
        $this->importJson($json, $testType->id);
    }

    private function importJson(string $path, int $testTypeId): void{
        $rows = json_decode(file_get_contents($path), true);
        foreach ($rows as $row){
            $row['test_type_id'] = $testTypeId;
            ReferenceValue::create($row);
        }
    }
}
