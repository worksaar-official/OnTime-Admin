<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$item = DB::table('items')->first();
$store = DB::table('stores')->where('id', 3)->first();

echo "Item ID: " . ($item->id ?? 'None') . "\n";
echo "Item Price: " . ($item->price ?? 'None') . "\n";
echo "Store ID: " . ($store->id ?? 'None') . "\n";
echo "Store Module ID: " . ($store->module_id ?? 'None') . "\n";
