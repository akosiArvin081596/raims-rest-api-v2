<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('assistance_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assistance_request_id')->constrained()->onDelete('cascade'); // Link to the assistance request
            $table->string('item_name');
            $table->integer('quantity');
            $table->enum('status', ['pending', 'delivered'])->default('pending'); // Add status column
            $table->timestamp('delivery_date')->nullable(); // Add delivery_date column
            $table->foreignId('delivery_user_id')->nullable()->constrained('users')->onDelete('set null'); // Add delivery_user_id column
            $table->timestamps(); // Created at, updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('assistance_request_items');
    }
};