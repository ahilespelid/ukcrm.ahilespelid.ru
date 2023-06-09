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
        Schema::create('indication_electricity_day', function (Blueprint $table) {
            $table->id();
            $table->string('indication')->nullable(); //показания
            $table->timestamps(); //даты created_at и updated_at
            $table->boolean('active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indication_electricity_day');
    }
};
