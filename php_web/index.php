<?php
require_once './bubble-sort-v2.php';
$list = json_decode(file_get_contents('php://input'));
$start = hrtime(true);
bubbleSort($list);
$end = hrtime(true);
echo $end - $start;
