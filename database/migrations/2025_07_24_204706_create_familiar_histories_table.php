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
        Schema::create('familiar_histories', function (Blueprint $table) {
            $table->id();
            $table->string('allergy');
            $table->string('relative');
            $table->string('note')->nullable();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('familiar_histories');
    }
};
