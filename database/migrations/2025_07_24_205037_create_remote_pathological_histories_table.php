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
        Schema::create('remote_pathological_histories', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->string('description');
            $table->string('note')->nullable();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remote_pathological_histories');
    }
};
