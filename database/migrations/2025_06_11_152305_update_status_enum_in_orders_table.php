<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // 1. Supprimer la contrainte de vérification
            DB::statement("ALTER TABLE orders DROP CONSTRAINT IF EXISTS orders_status_check");
            // 2. Mettre à jour les anciennes valeurs
            DB::table('orders')->where('status', 'order')->update(['status' => 'ordered']);
            
            // 3. Ajouter la nouvelle contrainte
            DB::statement("ALTER TABLE orders ADD CONSTRAINT orders_status_check CHECK (status IN ('ordered', 'paid', 'delivered', 'received'))");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // 1. Supprimer la nouvelle contrainte
            DB::statement("ALTER TABLE orders DROP CONSTRAINT IF EXISTS orders_status_check");

            // 2. Revenir aux anciennes valeurs
            DB::table('orders')->where('status', 'ordered')->update(['status' => 'order']);

            // 3. Recréer l’ancienne contrainte
            DB::statement("ALTER TABLE orders ADD CONSTRAINT orders_status_check CHECK (status IN ('order', 'paid', 'delivered', 'received'))");
        });
    }
};
