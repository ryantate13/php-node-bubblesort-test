<?php
$n = intval($argv[1]);
$nums = range(1, $n);
shuffle($nums);
file_put_contents('list.json', json_encode($nums));