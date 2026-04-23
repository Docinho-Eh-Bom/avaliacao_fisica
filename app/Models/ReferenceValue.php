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
        'p0', // p < 40 weak
        'p40', // 59 >= p > 40 average
        'p60', // > 79 >= p >= 60 good
        'p80', // 80 <= p <= 98 very good
        'p98', //p > 98 excellent
        'min_value',
        'max_value',
        'label'
    ];

    protected $casts = [
    'p0' => 'float',
    'p40' => 'float',
    'p60' => 'float',
    'p80' => 'float',
    'p98' => 'float',
    'min_value' => 'float',
    'max_value' => 'float',
];
}
