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
    // Blog posts table
    Schema::create('blog_posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('excerpt')->nullable();
        $table->longText('content');
        $table->string('featured_image')->nullable(); // Main image for listing
        $table->string('author')->nullable();
        $table->string('category')->nullable();
        $table->json('tags')->nullable();
        $table->integer('views')->default(0);
        $table->integer('read_time')->nullable();
        $table->boolean('is_published')->default(false);
        $table->boolean('is_featured')->default(false);
        $table->dateTime('published_at')->nullable();
        $table->text('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->text('meta_keywords')->nullable();
        $table->timestamps();
    });

    // Blog images table (for multiple images per post)
    Schema::create('blog_images', function (Blueprint $table) {
        $table->id();
        $table->foreignId('blog_post_id')->constrained('blog_posts')->onDelete('cascade');
        $table->string('image_path');
        $table->string('caption')->nullable();
        $table->integer('display_order')->default(0);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('blog_images');
    Schema::dropIfExists('blog_posts');
}
};
