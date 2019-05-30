<?php

function parse_metric(string $m)
{
    $first = trim(explode('[', $m)[0]);
    return is_numeric($first) ? floatval($first) : $first;
}

function parse_stats(string $line)
{
    $stats_string = trim(explode(':', $line)[1]);
    $stats_vals = preg_split('/\s+/', $stats_string);
    $stats = array_map('floatval', $stats_vals);
    return array_combine(['min', 'mean', 'sd', 'median', 'max'], $stats);
}

function algorithm_stats(array $results)
{
    sort($results);
    $n = count($results);
    $average = $n ? (array_sum($results) / $n) : 0;
    $stats = [
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

function parse_ab(string $log)
{
    $lines = explode("\n", $log);
    $split_at = null;
    foreach ($lines as $i => $line) {
        if (strpos($line, 'Server Software:') === 0) {
            $split_at = $i;
            break;
        }
    }
    $http_output = array_slice($lines, 0, $split_at);
    $lines = array_slice($lines, $split_at - 1);
    $results = [
        'bubblesort_time' => algorithm_stats(array_map('intval', array_filter($http_output, 'is_numeric')))
    ];
    $metrics = [
        'Server Software',
        'Server Hostname',
        'Concurrency Level',
        'Time taken for tests',
        'Complete requests',
        'Failed requests',
        'Total transferred',
        'Total body sent',
        'HTML transferred',
        'Requests per second',
        'Time per request',
        'Transfer rate',
    ];
    foreach ($lines as $i => $line) {
        foreach ($metrics as $metric) {
            if (strpos($line, $metric . ':') === 0) {
                $key = implode('_', explode(' ', strtolower($metric)));
                $results[$key] = $results[$key] ?? parse_metric(substr($line, strlen($metric) + 1));
                unset($lines[$i]);
            }
        }
    }
    $results['connection_times_ms'] = [];
    $conn_stats = [
        'Connect',
        'Processing',
        'Waiting',
        'Total',
    ];
    foreach ($conn_stats as $conn_stat) {
        foreach ($lines as $i => $line) {
            if (strpos($line, $conn_stat . ':') === 0) {
                $key = strtolower($conn_stat);
                $results['connection_times_ms'][$key] = parse_stats($line);
                unset($lines[$i]);
            }
        }
    }
    $results['percent_served_within_ms'] = array_reduce($lines, function ($a, $c) {
        if (strpos($c, '%')) {
            $parts = array_map('intval', explode('%', $c));
            $a[$parts[0]] = $parts[1];
        }
        return $a;
    });
    return $results;
}

$concurrent = $argv[1];
$platform = $argv[2];
$ab = `ab -v 2 -l -p list.json -T application/json -c $concurrent -n 10000 http://$platform/`;

echo json_encode(parse_ab($ab)) . "\n";