<?php

function algorithm_stats(string $runner, int $list_size, array $results)
{
    sort($results);
    $n = count($results);
    $average = $n ? (array_sum($results) / $n) : 0;
    $stats = [
        'runner' => $runner,
        'list_size' => $list_size,
        'runs' => $n,
        'min' => min($results),
        'max' => max($results),
        'mean' => $average
    ];
    $even = $n % 2 === 0;
    $mid = $n / 2;
    $stats['median'] = $even ? (($results[$mid - 1] + $results[$mid]) / 2) : $results[intval(floor($mid))];
    if ($average) {
        foreach ($results as $i => $_)
            $results[$i] = ($results[$i] - $average) ** 2;
        $stats['sd'] = sqrt(array_sum($results) / $n);
    } else
        $stats['sd'] = 0;
    foreach (['mean', 'median', 'sd'] as $k)
        $stats[$k] = round($stats[$k]);
    return $stats;
}

$runners = [
    'php' => 'php',
    'node' => 'js',
    'rust' => ''
];

$number_of_runs = 1000;

$stats = [];

$log_file = 'benchmark.cli.log';

file_put_contents($log_file, '');

foreach ($runners as $bin => $ext) {
    foreach (range(1, 10) as $n) {
        $list_size = $n * 100;
        error_log("testing $bin with list size $list_size");
        `php mk_list.php $list_size`;
        $results = [];
        $run_cmd = $ext ? "$bin test.$ext" : './test';
        for ($i = 0; $i < $number_of_runs; ++$i){
            $results[] = intval(`$run_cmd`);
            $j = $i + 1;
            if($j && !($j % ($number_of_runs / 10)) && $j !== $number_of_runs)
                error_log("Completed $j tests");
        }
        error_log("Finished $number_of_runs tests");
        $stat = algorithm_stats($bin, $list_size, $results);
        $stats[] = $stat;
        file_put_contents($log_file, json_encode($stat) . "\n", FILE_APPEND);
    }
}