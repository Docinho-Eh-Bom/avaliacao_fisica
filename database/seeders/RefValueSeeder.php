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
        $json = storage_path('app/reference-values/flexibility.json');
        $this->importJson($json, $testType->id);
    }

    private function seedAbdominal(): void{
        $testType = TestType::where('name', 'Força Abdominal')->first();
        $json = storage_path('app/reference-values/abdominal.json');
        $this->importJson($json, $testType->id);
    }

    private function seedCardio(): void{
        $testType = TestType::where('name', 'Aptidão Cardiorrespiratória')->first();
        $json = storage_path('app/reference-values/cardio.json');
        $this->importJson($json, $testType->id);
    }

    private function seedUpperBody(): void{
        $testType = TestType::where('name', 'Força Membros Superiores')->first();
        $json = storage_path('app/reference-values/upper.json');
        $this->importJson($json, $testType->id);
    }

    private function seedLowerBody(): void{
        $testType = TestType::where('name', 'Força Membros Inferiores')->first();
        $json = storage_path('app/reference-values/lower.json');
        $this->importJson($json, $testType->id);
    }

    private function seedAgility(): void{
        $testType = TestType::where('name', 'Agilidade')->first();
        $json = storage_path('app/reference-values/agility.json');
        $this->importJson($json, $testType->id);
    }

    private function seedSpeed(): void{
        $testType = TestType::where('name', 'Velocidade')->first();
        $json = storage_path('app/reference-values/speed.json');
        $this->importJson($json, $testType->id);
    }

    private function seedBMI(): void{
        $testType = TestType::where('name', 'IMC')->first();
        $json = storage_path('app/reference-values/bmi.json');
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
