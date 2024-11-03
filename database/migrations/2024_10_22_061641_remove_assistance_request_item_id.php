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
        Schema::table('delivery_user_assignments', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['assistance_request_item_id']);
            
            // Then drop the column
            $table->dropColumn('assistance_request_item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_user_assignments', function (Blueprint $table) {
            // Add the column back
            $table->unsignedBigInteger('assistance_request_item_id')->nullable();
            
            // Re-add the foreign key constraint
            $table->foreign('assistance_request_item_id')->references('id')->on('assistance_request_items')->onDelete('cascade');
        });
    }
};
