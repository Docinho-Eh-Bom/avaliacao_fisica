<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    protected $fillable = ['name', 'unit', 'calc_type', 'calc_key','higher', 'is_active', 'description', 'video_url'];

    public function results(){
        return $this->hasMany(TestResult::class);
    }
}
