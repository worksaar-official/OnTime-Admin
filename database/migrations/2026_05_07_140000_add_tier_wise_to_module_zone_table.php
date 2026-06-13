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
        Schema::table('module_zone', function (Blueprint $table) {
            // Update enum type using raw SQL as Laravel's change() doesn't support ENUM update easily without doctrine/dbal
            DB::statement("ALTER TABLE module_zone MODIFY COLUMN delivery_charge_type ENUM('fixed', 'distance', 'tier') NOT NULL DEFAULT 'distance'");
            
            $table->tinyInteger('tier_wise_delivery_charge')->default(0)->after('delivery_charge_type');
            $table->text('tiered_delivery_charge')->nullable()->after('tier_wise_delivery_charge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('module_zone', function (Blueprint $table) {
            $table->dropColumn(['tier_wise_delivery_charge', 'tiered_delivery_charge']);
            DB::statement("ALTER TABLE module_zone MODIFY COLUMN delivery_charge_type ENUM('fixed', 'distance') NOT NULL DEFAULT 'distance'");
        });
    }
};
