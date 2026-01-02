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
    Schema::create('administration', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('position');
        $table->string('department')->nullable(); // e.g., "Academic", "Finance", "Student Affairs"
        $table->text('bio')->nullable();
        $table->string('photo')->nullable();
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('office_location')->nullable();
        $table->string('office_hours')->nullable();
        $table->integer('years_of_service')->nullable();
        $table->json('social_links')->nullable();
        $table->integer('display_order')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administration');
    }
};
