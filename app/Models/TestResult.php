<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = ['battery_id', 'test_type_id', 'value', 'classification', 'final_value'];

    public function battery(){
        return $this->belongsTo(TestBattery::class);
    }

    public function testType(){
        return $this->belongsTo(TestType::class);
    }

    public function getClassificationLabelAttribute(): string{
        return match($this->classification){
            'weak' => 'Fraco',
            'average' => 'Razoável',
            'good' => 'Bom',
            'very_good' => 'Muito Bom',
            'excellent' => 'Excelente',
            'healthy' => 'Zona Saudável',
            'risk' => 'Risco à Saúde',
            default => 'Não classificado'
        };
    }
}
