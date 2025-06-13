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
            $table->enum('status', ['active', 'pending', 'desactive'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop enum and revert back to string
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->default('pending');
        });
    }
};
