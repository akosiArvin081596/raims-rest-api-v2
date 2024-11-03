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
            // Only add columns if they don't exist yet
            if (!Schema::hasColumn('assistance_request_items', 'status')) {
                $table->enum('status', ['pending', 'delivered'])->default('pending'); // Status column
            }

            if (!Schema::hasColumn('assistance_request_items', 'delivery_date')) {
                $table->timestamp('delivery_date')->nullable(); // Delivery date
            }

            if (!Schema::hasColumn('assistance_request_items', 'delivery_user_id')) {
                $table->foreignId('delivery_user_id')->nullable()->constrained('users')->onDelete('set null'); // Delivery user
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assistance_request_items', function (Blueprint $table) {
            // Drop the columns if they exist
            if (Schema::hasColumn('assistance_request_items', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('assistance_request_items', 'delivery_date')) {
                $table->dropColumn('delivery_date');
            }

            if (Schema::hasColumn('assistance_request_items', 'delivery_user_id')) {
                $table->dropForeign(['delivery_user_id']);
                $table->dropColumn('delivery_user_id');
            }
        });
    }
};
