<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDeliveryUserIdFromAssistanceRequestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assistance_request_items', function (Blueprint $table) {
            // First, drop the foreign key constraint if there is one
            $table->dropForeign(['delivery_user_id']);  // If there is a foreign key constraint on 'delivery_user_id'
            
            // Now, drop the 'delivery_user_id' column
            $table->dropColumn('delivery_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assistance_request_items', function (Blueprint $table) {
            // Re-add the 'delivery_user_id' column with foreign key
            $table->foreignId('delivery_user_id')->constrained('users')->onDelete('cascade');
        });
    }
}
