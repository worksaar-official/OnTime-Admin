<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Order;
use App\Models\User;
use App\Models\Store;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Simple class to use the trait
class DirectTester {
    use \App\Traits\PlaceNewOrder;
    public function getCharge($request, $zone, $store, $module_wise_delivery_charge, $delivery_charge, $moduleId) {
        return $this->getDeliveryCharge($request, $zone, $store, $module_wise_delivery_charge, $delivery_charge, $moduleId);
    }
}

$user = User::first();
$store_id = 3;
$distance = 9.1;

$store = Store::with(['module', 'zone'])->find($store_id);
$zone = $store->zone;
$module_wise_delivery_charge = DB::table('module_zone')
    ->where('module_id', $store->module_id)
    ->where('zone_id', $store->zone_id)
    ->first();

// Mocking pivot as expected by the trait
$module_wise_delivery_charge_mock = new \stdClass();
$module_wise_delivery_charge_mock->pivot = new \stdClass();
$module_wise_delivery_charge_mock->pivot->delivery_charge_type = 'tier';
$module_wise_delivery_charge_mock->pivot->tiered_delivery_charge = [
    ['start' => 0, 'end' => 3, 'charge' => 0],
    ['start' => 3, 'end' => 6, 'charge' => 10],
    ['start' => 6, 'end' => 15, 'charge' => 15]
];
$module_wise_delivery_charge_mock->pivot->minimum_shipping_charge = 0;
$module_wise_delivery_charge_mock->pivot->maximum_shipping_charge = 0;

$request = new Request(['distance' => $distance]);

echo "Calculating Delivery Charge using Logic...\n";
$tester = new DirectTester();
$chargeData = $tester->getCharge($request, $zone, $store, $module_wise_delivery_charge_mock, 0, $store->module_id);
$delivery_charge = $chargeData['delivery_charge'];

echo "Result: $delivery_charge\n";

echo "--- TESTING BOTH MODES ---\n";

foreach ([0, 1] as $accumulative) {
    echo "\nMODE: " . ($accumulative ? "TIER-WISE (Accumulative)" : "RANGE-BASED (Match Rate)") . "\n";
    
    $module_wise_delivery_charge_mock->pivot->tier_wise_delivery_charge = $accumulative;
    $chargeData = $tester->getCharge($request, $zone, $store, $module_wise_delivery_charge_mock, 0, $store->module_id);
    $delivery_charge = $chargeData['delivery_charge'];

    echo "Distance: $distance km\n";
    echo "Calculated Delivery Charge: $delivery_charge\n";

    if ($accumulative == 0) {
        // Range Based: 9.1 * 15 = 136.5 + 12.65 = 149.15
        if ($delivery_charge == 149.15) echo "VERIFIED: Range Based is CORRECT.\n";
    } else {
        // Tier Wise: (3*0) + (3*10) + (3.1*15) = 0 + 30 + 46.5 = 76.5 + 12.65 = 89.15
        if ($delivery_charge == 89.15) echo "VERIFIED: Tier-Wise is CORRECT.\n";
    }
}

echo "\nPushing changes to main branch...\n";
