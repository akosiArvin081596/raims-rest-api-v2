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
        Schema::create('delivery_user_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_user_id')->constrained('users')->onDelete('cascade'); // Delivery User
            $table->foreignId('assistance_request_id')->constrained('assistance_requests')->onDelete('cascade'); // Assigned to request instead of individual items
            $table->timestamp('delivery_date')->nullable(); // Track when the request was delivered
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_user_assignments');
    }
};
