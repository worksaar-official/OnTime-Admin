<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Store;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class TestOrder {
    use \App\Traits\PlaceNewOrder;
    
    public function testGetDeliveryCharge($request, $zone, $store, $module_wise_delivery_charge, $delivery_charge, $moduleId) {
        return $this->getDeliveryCharge($request, $zone, $store, $module_wise_delivery_charge, $delivery_charge, $moduleId);
    }
}

$tester = new TestOrder();

$store_id = 3;
$distance = 9.1;

$store = Store::with(['module', 'zone', 'storeConfig'])->find($store_id);
$zone = $store->zone;
$module_wise_delivery_charge = DB::table('module_zone')
    ->where('module_id', $store->module_id)
    ->where('zone_id', $store->zone_id)
    ->first();

// Mocking pivot properties as expected by the trait
$module_wise_delivery_charge_mock = new \stdClass();
$module_wise_delivery_charge_mock->pivot = new \stdClass();
$module_wise_delivery_charge_mock->pivot->delivery_charge_type = 'tier'; // Manually setting to tier to test our new logic
$module_wise_delivery_charge_mock->pivot->tiered_delivery_charge = json_decode($module_wise_delivery_charge->tiered_delivery_charge, true);
$module_wise_delivery_charge_mock->pivot->minimum_shipping_charge = $module_wise_delivery_charge->minimum_shipping_charge;
$module_wise_delivery_charge_mock->pivot->maximum_shipping_charge = $module_wise_delivery_charge->maximum_shipping_charge;

$request = new Request([
    'distance' => $distance,
    'order_type' => 'delivery',
    'store_id' => $store_id
]);

// Call the method we updated
$result = $tester->testGetDeliveryCharge(
    $request, 
    $zone, 
    $store, 
    $module_wise_delivery_charge_mock, 
    0, 
    $store->module_id
);

echo "Simulation Result for 9.1km with Tiers:\n";
print_r($result);
