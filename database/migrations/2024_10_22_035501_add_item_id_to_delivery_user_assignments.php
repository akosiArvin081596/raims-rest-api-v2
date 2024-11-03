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
            $table->unsignedBigInteger('assistance_request_item_id')->nullable(); // Assuming it's nullable initially
            $table->foreign('assistance_request_item_id')->references('id')->on('assistance_request_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_user_assignments', function (Blueprint $table) {
            $table->dropForeign(['assistance_request_item_id']);
            $table->dropColumn('assistance_request_item_id');
        });
    }
};
