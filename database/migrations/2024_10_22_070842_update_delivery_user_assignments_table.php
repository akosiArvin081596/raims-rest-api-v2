<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('delivery_user_assignments', function (Blueprint $table) {
            // Check if assistance_request_item_id already exists before adding it
            if (!Schema::hasColumn('delivery_user_assignments', 'assistance_request_item_id')) {
                $table->unsignedBigInteger('assistance_request_item_id')->nullable()->after('delivery_user_id');
            }
            // Apply the foreign key constraint now
            $table->foreign('assistance_request_item_id')
                ->references('id')->on('assistance_request_items')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('delivery_user_assignments', function (Blueprint $table) {
            $table->dropForeign(['assistance_request_item_id']);
            $table->dropColumn('assistance_request_item_id');
        });
    }
};

