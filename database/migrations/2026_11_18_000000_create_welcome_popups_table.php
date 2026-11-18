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
        Schema::create('welcome_popups', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Welcome to DIARAX Medical Systems');
            $table->string('badge')->nullable()->default('South Korea Precision Medical Technology');
            $table->text('message');
            $table->string('image')->nullable();
            $table->string('button_text')->nullable()->default('Explore Equipment Catalog');
            $table->string('button_link')->nullable()->default('/products');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welcome_popups');
    }
};
