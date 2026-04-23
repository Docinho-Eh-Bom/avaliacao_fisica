<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    protected $fillable = ['name', 'unit', 'calc_type', 'calc_key', 'is_active'];

    public function results(){
        return $this->hasMany(TestResult::class);
    }
}
