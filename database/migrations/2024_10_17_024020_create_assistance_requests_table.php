<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assistance_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to LGU user
            $table->string('dromic_report_path'); // Path to the DROMIC report file
            $table->string('letter_of_request_path'); // Path to the letter of request file
            $table->timestamps(); // Created at, updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('assistance_requests');
    }
};
