<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('callback_sections', function (Blueprint $table) {
            $table->id();
            $table->string('content_title'); // ফ্রি কলে পরামর্শ নিন...
            $table->text('content_description'); // বর্ণনা
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('callback_sections');
    }
};