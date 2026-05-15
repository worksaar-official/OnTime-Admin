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
        $table_name = Schema::hasTable('store_configs')?  'store_configs' : 'storeConfigs';
        Schema::table($table_name, function (Blueprint $table) use ($table_name) {
            if (!Schema::hasColumn($table_name, 'extra_packaging_default')) {
                $table->boolean('extra_packaging_default')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table_name = Schema::hasTable('store_configs')?  'store_configs' : 'storeConfigs';
        Schema::table($table_name, function (Blueprint $table) use ($table_name) {
            if (Schema::hasColumn($table_name, 'extra_packaging_default')) {
                $table->dropColumn('extra_packaging_default');
            }
        });
    }
};
