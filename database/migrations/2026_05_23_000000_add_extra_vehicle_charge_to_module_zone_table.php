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
        Schema::table('module_zone', function (Blueprint $table) {
            $table->boolean('extra_vehicle_charge')->default(0)->after('maximum_cod_order_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('module_zone', function (Blueprint $table) {
            $table->dropColumn('extra_vehicle_charge');
        });
    }
};
