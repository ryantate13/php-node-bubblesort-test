<?php

$runners = [
    'php' => 'php',
    'node' => 'js'
];


// multipliers convert to nanoseconds
$time_multipliers = [
    'php' => 1e9,
    'node' => 1
];

$tests = [
    'php' => [],
    'node' => []
];

$number_of_runs = 100;

foreach (range(1, $number_of_runs) as $_)
    foreach ($runners as $bin => $ext)
        $tests[$bin][] = floatval(`$bin bubble-sort-v2.$ext`) * $time_multipliers[$bin];

foreach ($tests as $type => $results)
    echo "time elapsed (nanoseconds) for $type is " . number_format(floor(min($results))) . "\n";