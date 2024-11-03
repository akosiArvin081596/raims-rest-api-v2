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
        Schema::table('delivery_user_assignments', function (Blueprint $table) {
            // Drop the 'delivery_date' column from the 'delivery_user_assignments' table
            $table->dropColumn('delivery_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_user_assignments', function (Blueprint $table) {
            // Add the 'delivery_date' column back in case of rollback
            $table->timestamp('delivery_date')->nullable();
        });
    }
};
