<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceValue extends Model
{
    protected $fillable = [
        'test_type_id',
        'age_min',
        'age_max',
        'gender',
        'type',
        'min_value',
        'max_value',
        'label'
    ];

    protected $casts = [
    'min_value' => 'float',
    'max_value' => 'float',
];
}
