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
        Schema::create('spot', function (Blueprint $table) {
            $table->string("activation_callsign");
            $table->string("spotter_id");
            $table->string("location");
            $table->string("frequency");
            $table->string("mode");
            $table->string("time");
            $table->string("Qso_type");
            $table->string("type");
            $table->string("comments")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spot');
    }
};
