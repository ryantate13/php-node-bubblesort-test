<?php
$nums = range(1, 1000);
shuffle($nums);
file_put_contents('list.json', json_encode($nums));