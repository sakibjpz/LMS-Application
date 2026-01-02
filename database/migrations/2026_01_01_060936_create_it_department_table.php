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
    Schema::create('it_department', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('position');
        $table->text('bio')->nullable();
        $table->string('photo')->nullable();
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('expertise')->nullable(); // e.g., "Network Security, Cloud Computing"
        $table->integer('experience_years')->nullable();
        $table->json('social_links')->nullable(); // Store as JSON: {linkedin: '', github: '', twitter: ''}
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
        Schema::dropIfExists('it_department');
    }
};
