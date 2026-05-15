<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$zone = App\Models\Zone::first();
if (!$zone) die("No zone found\n");

// Try to get a point from the coordinates
$coords = $zone->coordinates[0]; // Assuming it's a collection of polygons
print_r($coords);
