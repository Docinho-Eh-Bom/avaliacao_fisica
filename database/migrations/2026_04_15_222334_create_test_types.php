<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');//abdominal, arterial, pulo etc etc
            $table->string('unit');//repetições, segundos, metros, etc
            $table->enum('calc_type', ['direct', 'derived']);//direto | derivado
            $table->string('calc_key')->nullable();//nome calc (bmi, imc, vo2 etc)
            $table->boolean('higher')->default(true);//para classificao entre alunos
            $table->boolean('is_active')->default(true);//para o delete, vai ser so um switch de true/false
            $table->text('description')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_types');
    }
};
