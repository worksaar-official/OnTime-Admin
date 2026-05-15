<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Order;
use App\Models\User;
use App\Models\Store;
use App\Http\Controllers\Api\V1\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

$user = User::first();
if (!$user) die("No user found\n");

$store_id = 3;
$distance = 9.1;

// Prepare Request for API endpoint
$request = new Request([
    'store_id' => $store_id,
    'order_type' => 'delivery',
    'distance' => $distance,
    'address' => 'Local Test Address',
    'latitude' => '24.8476989',
    'longitude' => '87.2307523',
    'payment_method' => 'cash_on_delivery',
    'order_amount' => 159.15, // Approx (10 item + 149.15 delivery)
    'cart' => json_encode([
        [
            'item_id' => 1, 
            'price' => 10, 
            'quantity' => 1,
            'variation' => [],
            'add_ons' => []
        ]
    ]),
    'contact_person_name' => 'Local Tester',
    'contact_person_number' => '9876543210',
    'contact_person_email' => 'local@test.com',
    'address_type' => 'Home',
    'guest_id' => 1,
    'is_buy_now' => 1
]);

$request->headers->set('moduleId', '6');
$request->headers->set('Authorization', 'Bearer dummy');

// Debug getModuleId
echo "Testing getModuleId('6'): " . getModuleId('6') . "\n";

$request->setUserResolver(function () use ($user) {
    return $user;
});

echo "Creating Real Order on Local...\n";

$controller = new OrderController();
try {
    $response = $controller->place_order($request);
    $data = json_decode($response->getContent(), true);

    if (isset($data['order_id'])) {
        $order = Order::find($data['order_id']);
        echo "SUCCESS! Order Created.\n";
        echo "Order ID: " . $order['id'] . "\n";
        echo "Distance: " . $order['distance'] . " km\n";
        echo "Calculated Delivery Charge: " . $order['delivery_charge'] . "\n";
        
        if ($order['delivery_charge'] == 149.15) {
            echo "RESULT: CORRECT (136.5 tier + 12.65 vehicle)\n";
        } else {
            echo "RESULT: INCORRECT (Value: " . $order['delivery_charge'] . ")\n";
        }
    } else {
        echo "FAILED to create order.\n";
        echo "Raw Response Body:\n";
        print_r($data);
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
