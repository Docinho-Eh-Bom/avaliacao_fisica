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

            $table->enum('type', ['percentile', 'absolute']);//no caso se a tabela de referencia preferida for percentil/resultados para a comparação]

            //percentil
            $table->float('p0')->nullable();//fraco
            $table->float('p40')->nullable();//razoavel
            $table->float('p60')->nullable();//bom
            $table->float('p80')->nullable();//muito bom
            $table->float('p98')->nullable();//excelent

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
