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
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('battery_id')
                    ->constrained('test_batteries')
                    ->cascadeOnDelete();

            $table->foreignId('test_type_id')
                    ->constrained()
                    ->cascadeOnDelete();

            $table->unique([
                'battery_id',
                'test_type_id'
            ]);

            $table->float('value')->nullable();
            $table->string('classification')->nullable();
            $table->float('final_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
