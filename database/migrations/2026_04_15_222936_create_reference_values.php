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
        Schema::create('reference_values', function (Blueprint $table) {
            $table->id();

            $table->foreignId('test_type_id')->constrained();

            $table->integer('age_min');
            $table->integer('age_max');
            $table->char('gender', 1);

            $table->enum('type', ['derived', 'absolute']);//no caso se a tabela de referencia preferida for percentil/resultados para a comparação]

            //valor final absoluto (valor min e valor max, depende do user ditar oq é aceitavel)
            $table->float('min_value')->nullable();
            $table->float('max_value')->nullable();
            $table->string('label')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reference_values');
    }
};
