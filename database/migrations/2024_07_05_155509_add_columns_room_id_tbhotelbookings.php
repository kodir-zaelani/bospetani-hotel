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
        Schema::table('hotelbookings', function (Blueprint $table) {
            $table->foreignUuid('hotelroom_id')->after('hotel_id')->constrained()->onDelete('cascade');
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::table('hotelbookings', function (Blueprint $table) {
            $table->dropForeign(['hotelroom_id']);
            $table->dropColumn('hotelroom_id');
        });
    }
};
