<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$vehicles = DB::table('d_m_vehicles')->get();
foreach ($vehicles as $v) {
    echo "ID: {$v->id}, Name: {$v->type}, Extra Charge: {$v->extra_charges}\n";
}
