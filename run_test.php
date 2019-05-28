<?php

$runners = [
    'php' => 'php',
    'node' => 'js'
];

$tests = [];

$number_of_runs = 100;

foreach (range(1, 10) as $n) {
    $list_size = $n * 100;
    `php mk_list.php $list_size`;
    foreach ($runners as $bin => $ext) {
        $tests[$list_size][$bin] = [];
        foreach (range(1, $number_of_runs) as $_)
            $tests[$list_size][$bin][] = floatval(`$bin test.$ext`);
    }
}

foreach ($tests as $list_size => $results) {
    echo "list size: $list_size\n";
    foreach ($results as $type => $result)
        echo "time elapsed (nanoseconds) for $type is " . number_format(floor(min($result))) . "\n";
}