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
        Schema::create('allergy_tests', function (Blueprint $table) {
            $table->id();
            $table->date('test_date');
            $table->string('test_type');
            $table->string('test_result');
            $table->string('test_note')->nullable();
            $table->foreignId('visit_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergy_tests');
    }
};
