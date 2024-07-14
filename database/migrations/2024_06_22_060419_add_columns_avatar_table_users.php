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
        Schema::table('users', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
            $table->string('username', 50)->unique()->nullable()->after('email');
            $table->string('displayname', 50)->nullable()->after('username');
            $table->string('phone_number',20)->unique()->nullable()->after('displayname');
            $table->string('avatar')->nullable()->after('phone_number');
            $table->text('bio')->nullable()->after('avatar');
            $table->boolean('status')->default(true)->after('bio');
            $table->boolean('masterstatus')->default(false)->after('status');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('username');
            $table->dropColumn('displayname');
            $table->dropColumn('phone_number');
            $table->dropColumn('avatar');
            $table->dropColumn('bio');
            $table->dropColumn('status');
            $table->dropColumn('masterstatus');
            $table->dropSoftDeletes();
        });
    }
};
