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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->date('birthdate');
            $table->string('gender');
            $table->string('birthplace');
            $table->string('tax_code')->unique();
            $table->string('marital_status')->nullable();
            $table->string('nationality');
            $table->string('city');
            $table->string('province');
            $table->string('address');
            $table->string('street_number');
            $table->string('zip_code');
            $table->string('domicile_city')->nullable();
            $table->string('domicile_province')->nullable();
            $table->string('domicile_address')->nullable();
            $table->string('domicile_street_number')->nullable();
            $table->string('domicile_zip_code')->nullable();
            $table->string('telephone');
            $table->string('email');
            $table->string('occupation')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
