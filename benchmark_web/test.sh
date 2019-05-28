#!/usr/bin/env bash
echo '' > benchmark.log
for platform in node php
    do
    for i in $(seq 1 10)
    do
        n=$(($i * 100))
        php mk_list.php $n
        echo testing $platform with list size $n
        ab -l -p list.json -T application/json -c 10 -n $n http://$platform/ >> benchmark.log
    done
done
echo done!