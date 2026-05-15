<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Store;
use App\Models\Module;

$store_id = 3; // Checking for Store ID 3 as per your previous requests
$store = Store::with('module')->find($store_id);

if (!$store) {
    die("Store not found\n");
}

$module_id = $store->module_id;
$zone_id = $store->zone_id;

$module_wise_delivery_charge = DB::table('module_zone')
    ->where('module_id', $module_id)
    ->where('zone_id', $zone_id)
    ->first();

echo "Store ID: $store_id\n";
echo "Module ID: $module_id\n";
echo "Zone ID: $zone_id\n";
echo "Per KM Charge: " . ($module_wise_delivery_charge->per_km_shipping_charge ?? 'N/A') . "\n";
echo "Min Shipping: " . ($module_wise_delivery_charge->minimum_shipping_charge ?? 'N/A') . "\n";
echo "Delivery Type: " . ($module_wise_delivery_charge->delivery_charge_type ?? 'N/A') . "\n";
echo "Tier Data: " . ($module_wise_delivery_charge->tiered_delivery_charge ?? 'N/A') . "\n";
echo "Tier Accumulative Flag: " . ($module_wise_delivery_charge->tier_wise_delivery_charge ?? 'N/A') . "\n";
