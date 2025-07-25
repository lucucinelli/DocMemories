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
        Schema::create('medicinals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('dosage');
            $table->string('usage');
            $table->string('period');
            $table->text('note')->nullable();
            $table->foreignId('visit_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicinals');
    }
};
