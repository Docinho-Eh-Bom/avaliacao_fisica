<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestBattery extends Model
{
    protected $fillable = ['student_id', 'weight', 'height', 'year'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function results(){
        return $this->hasMany(TestResult::class, 'battery_id');
    }
}
