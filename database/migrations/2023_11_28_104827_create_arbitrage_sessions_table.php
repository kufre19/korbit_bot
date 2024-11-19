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
        Schema::create('arbitrage_sessions', function (Blueprint $table) {
            $table->id();
            $table->string("user_id");
            $table->string("restart_timer");
            $table->string("number_of_response_left");
            $table->string("total_responses");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arbitrage_sessions');
    }
};
