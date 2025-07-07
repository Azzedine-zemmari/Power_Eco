<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Simple, effective indexes for PostgreSQL
        DB::statement("CREATE INDEX IF NOT EXISTS products_status_idx ON products (status)");
        DB::statement("CREATE INDEX IF NOT EXISTS products_category_idx ON products (categorie_id)");
        DB::statement("CREATE INDEX IF NOT EXISTS products_price_idx ON products (price)");
        DB::statement("CREATE INDEX IF NOT EXISTS products_name_idx ON products (name)");
        DB::statement("CREATE INDEX IF NOT EXISTS products_active_category_idx ON products (status, categorie_id) WHERE status = 'active'");
        DB::statement("CREATE INDEX IF NOT EXISTS products_active_price_idx ON products (status, price) WHERE status = 'active'");
    }
    
    public function down()
    {
        DB::statement("DROP INDEX IF EXISTS products_status_idx");
        DB::statement("DROP INDEX IF EXISTS products_category_idx");
        DB::statement("DROP INDEX IF EXISTS products_price_idx");
        DB::statement("DROP INDEX IF EXISTS products_name_idx");
        DB::statement("DROP INDEX IF EXISTS products_active_category_idx");
        DB::statement("DROP INDEX IF EXISTS products_active_price_idx");
    }
};
