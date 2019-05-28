<?php

require_once './bubble-sort-v2.php';

$nums = json_decode(file_get_contents('list.json'));

$start = hrtime(true);

bubbleSort($nums);

$end = hrtime(true);

echo $end - $start;
