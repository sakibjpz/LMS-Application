<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('benefits', function (Blueprint $table) {
            $table->id();
            // store svg/html for icon (use longText to allow inline SVG or <img> markup)
            $table->longText('icon')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            // optional: a small string to store icon color class like "blue" / "green"
            $table->string('icon_class')->nullable();
            // optional: controls display order
            $table->unsignedInteger('sort_order')->default(0);
            // optional: whether to show on frontend
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('benefits');
    }
};
