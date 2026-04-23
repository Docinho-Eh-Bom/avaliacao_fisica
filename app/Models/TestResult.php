<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = ['battery_id', 'test_type_id', 'value'];

    public function battery(){
        return $this->belongsTo(TestBattery::class);
    }

    public function testType(){
        return $this->belongsTo(TestType::class);
    }
}
