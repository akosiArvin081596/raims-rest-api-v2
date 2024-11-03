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
        Schema::table('assistance_request_items', function (Blueprint $table) {
            // Add a nullable column for delivery_date
            $table->date('delivery_date')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assistance_request_items', function (Blueprint $table) {
            $table->dropColumn('delivery_date');
        });
    }
};
