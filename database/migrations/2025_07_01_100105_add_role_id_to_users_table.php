<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the old selectedRole column
            $table->dropColumn('selectedRole');

            // Add the new foreign key role_id
            $table->foreignId('role_id')
                    ->default(1)
                    ->constrained('roles')
                    ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rollback changes
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
            $table->string('selectedRole');
        });
    }
};

