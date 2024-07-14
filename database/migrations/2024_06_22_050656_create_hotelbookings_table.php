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
        Schema::create('hotelbookings', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('proof');
            $table->date('check_in');
            $table->date('check_out');
            $table->unsignedBigInteger('total_days');
            $table->unsignedBigInteger('total_amount');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('hotel_id')->constrained()->onDelete('cascade');
            $table->boolean('is_paid');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotelbookings');
    }
};
