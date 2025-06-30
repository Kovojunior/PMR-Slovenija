<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// ukaz v terminalu za izdelavo template migracije: php artisan create_Listings_table
// ukaz za obdelavo in izvedbo migracije: php artisan migrate
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
//            $table->id();
//            $table->string("title");
//            // filepath do datoteke, lahko je vrednost null
//            $table->string("logo")->nullable();
//            // če izbrišemo userja, se bodo tudi njegovi listingi izbrisali
//            $table->foreignId("user_id")->constrained()->onDelete("cascade");
//            $table->string("tags");
//            $table->string("company");
//            $table->string("location");
//            $table->string("email");
//            $table->string("website");
//            // longText dovoli daljši tekst kot string
//            $table->longText("description");
//            $table->timestamps();

            $table->id();
            $table->string("My_Callsign");
            $table->string("Their_Callsign");
            $table->string("RST_Sent");
            $table->string("RST_Rcvd");
            $table->string("My_Grid");
            $table->string("Their_Grid");
            $table->string("Date_Time");
            $table->string("Freq");
            $table->string("Upload_Pic")->nullable();
            $table->longText("Notes")->nullable();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->decimal('QSO_Range', 8, 3);
            $table->string('Event_type');
            $table->string('QSO_Type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
