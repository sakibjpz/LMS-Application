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
        Schema::create('career_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // "সফল ক্যারিয়ার গড়তে সঠিক প্রোগ্রামটি বেছে নিন"
            $table->text('subtitle')->nullable(); // The long h2 text
            $table->string('first_btn_text')->nullable(); // "সকল কোর্স"
            $table->string('second_btn_text')->nullable(); // "কল বুক করুন"
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_sections');
    }
};