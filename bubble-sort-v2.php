<?php

function bubbleSort(array &$a)
{
    $len = count($a) - 1;
    $sorted = false;

    while (!$sorted) {
        $sorted = true;
        for ($i = 0; $i < $len; $i++) {
            $current = $a[$i];
            $next = $a[$i + 1];

            if ($next < $current) {
                $a[$i] = $next;
                $a[$i + 1] = $current;
                $sorted = false;
            }
        }
    }
}

$nums = json_decode(file_get_contents('list.json'));

$start = microtime(true);

bubbleSort($nums);

$end = microtime(true);

echo $end - $start;