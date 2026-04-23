<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'birth_date',
        'user_id',
        'class_group_id'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    public function tests(){
        return $this->hasMany(TestResult::class);
    }

    //calcular idade automaticamente
    public function getAgeAttribute(){
        return Carbon::parse($this->birth_date)->age;
    }

    //user responsavel do aluno
    public function user(){
        return $this->belongsTo(User::class);
    }

    //turma do aluno
    public function classGroup(){
        return $this->belongsTo(ClassGroup::class);
    }
}
