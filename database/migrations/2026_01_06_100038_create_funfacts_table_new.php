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
            $table->string('count'); // The number to display
            $table->string('title'); // Text below the number
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0); // For sorting
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funfacts');
    }
};