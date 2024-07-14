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
        Schema::create('hotelphotos', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('hotel_id')->constrained()->onDelete('cascade');
            $table->string('photo');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotelphotos');
    }
};
