<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funfacts', function (Blueprint $table) {
            $table->id();
            $table->string('count')->default('0'); // The number to display
            $table->string('title'); // Title below the number
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0); // For ordering funfacts
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funfacts');
    }
};