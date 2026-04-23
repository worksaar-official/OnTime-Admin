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
        Schema::table(Schema::hasTable('store_configs')?  'store_configs' : 'storeConfigs', function (Blueprint $table) {
            $table->boolean('extra_packaging_default')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Schema::hasTable('store_configs')?  'store_configs' : 'storeConfigs', function (Blueprint $table) {
            $table->dropColumn('extra_packaging_default');
        });
    }
};
