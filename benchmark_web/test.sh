printf '' > benchmark.log
for platform in php node
do
    for i in $(seq 1 10)
    do
        n=$(($i * 100))
        php mk_list.php $n
        echo testing $platform with list size $n
        php test.php $n $platform >> benchmark.log
    done
done
echo done!