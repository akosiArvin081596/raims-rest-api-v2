<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assistance_request_items', function (Blueprint $table) {
            // Drop the 'delivery_user_id' column if it exists
            if (Schema::hasColumn('assistance_request_items', 'delivery_user_id')) {
                $table->dropForeign(['delivery_user_id']);
                $table->dropColumn('delivery_user_id');
            }

            // Drop the 'delivery_date' column if it exists
            if (Schema::hasColumn('assistance_request_items', 'delivery_date')) {
                $table->dropColumn('delivery_date');
            }
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

            // Re-add the 'delivery_date' column
            $table->timestamp('delivery_date')->nullable();
        });
    }
};
