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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->enum('gender', ['M', 'F']);
            $table->date('birth_date');

            $table->foreignId('user_id')//id do user
                    ->constrained()
                    ->cascadeOnDelete();
            $table->foreignId('class_group_id') //id da turma
                    ->nullable()
                    ->constrained()
                    ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
