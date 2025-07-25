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
        Schema::create('physiological_histories', function (Blueprint $table) {
            $table->id();
            $table->string('birth')->nullable();
            $table->boolean('atopy')->nullable();
            $table->string('nursing')->nullable();
            $table->string('diet')->nullable();
            $table->string('habits')->nullable();
            $table->string('period')->nullable();
            $table->string('period_regularity')->nullable();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physiological_histories');
    }
};
