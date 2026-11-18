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
        Schema::table('products', function (Blueprint $table) {
            $table->string('certified_quality')->nullable()->default('ISO 13485')->after('status');
            $table->string('regulatory_standard')->nullable()->default('Korea MFDS')->after('certified_quality');
            $table->string('warranty')->nullable()->default('24 Months Global')->after('regulatory_standard');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['certified_quality', 'regulatory_standard', 'warranty']);
        });
    }
};
