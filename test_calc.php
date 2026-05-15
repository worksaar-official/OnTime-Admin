<?php

// Mocking the tiers and logic for quick verification
$distance = 9.1;
$tiers = [
    ['start' => 0, 'end' => 5, 'charge' => 3],
    ['start' => 5, 'end' => 10, 'charge' => 5],
];

$temp_charge = 0;
echo "Testing distance: $distance\n";

foreach ($tiers as $tier) {
    $t_start = (float)($tier['start'] ?? 0);
    $t_end = (float)($tier['end'] ?? 999999); // Mocking PHP_INT_MAX
    $t_rate = (float)($tier['charge'] ?? 0);

    if ($distance > $t_start) {
        $distance_in_tier = min($distance, $t_end) - $t_start;
        $addition = ($distance_in_tier * $t_rate);
        $temp_charge += $addition;
        echo "Tier ($t_start - $t_end) at Rate $t_rate: $distance_in_tier km added -> +$addition. Total so far: $temp_charge\n";
    }
}

echo "Final Delivery Charge: $temp_charge\n";
if (abs($temp_charge - 35.5) < 0.001) {
    echo "SUCCESS: Calculation matches 35.5!\n";
} else {
    echo "FAILED: Calculation does not match.\n";
}
