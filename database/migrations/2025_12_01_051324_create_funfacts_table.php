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
  Schema::create('funfacts', function (Blueprint $table) {
        $table->id();
        $table->string('title')->nullable();           // e.g. "expert instructors"
        $table->bigInteger('value')->default(0);      // numeric counter, e.g. 7520
        $table->text('svg_icon')->nullable();         // full svg markup or JSON ref to icon
        $table->string('color_class')->nullable();    // e.g. "svg-icon-color-1" (keeps design)
        $table->integer('sort_order')->default(0);    // display order
        $table->boolean('is_active')->default(true);  // toggle on/off from admin
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counters');
    }
};
