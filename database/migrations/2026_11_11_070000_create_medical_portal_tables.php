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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->default('heroicon-o-cube');
            $table->string('short_description')->nullable();
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(true);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('model_code')->index();
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('features')->nullable();
            $table->json('specifications')->nullable();
            $table->json('applications')->nullable();
            $table->string('brochure_pdf')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new')->default(false);
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->string('category')->default('Hospital Equipping');
            $table->text('overview')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->json('deliverables')->nullable();
            $table->json('benefits')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('organization')->nullable();
            $table->string('country')->nullable();
            $table->string('inquiry_type')->default('quote'); // quote, tender, support, general
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('status')->default('new'); // new, reviewed, contacted, closed
            $table->timestamps();
        });

        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Exhibition');
            $table->date('event_date')->nullable();
            $table->string('location')->nullable();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('products');
        Schema::dropIfExists('solutions');
        Schema::dropIfExists('categories');
    }
};

