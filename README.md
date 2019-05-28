# Bubblesort Speed Comparison
Compares bubble sort performance in Node and PHP running in CLI mode and as an HTTP server.

### Run CLI Tests

    make test/cli
    list size: 100
    time elapsed (nanoseconds) for php is 690,329
    time elapsed (nanoseconds) for node is 1,424,127
    list size: 200
    time elapsed (nanoseconds) for php is 2,706,607
    time elapsed (nanoseconds) for node is 4,992,812
    list size: 300
    time elapsed (nanoseconds) for php is 6,179,346
    time elapsed (nanoseconds) for node is 5,163,362
    list size: 400
    time elapsed (nanoseconds) for php is 12,378,367
    time elapsed (nanoseconds) for node is 5,389,730
    list size: 500
    time elapsed (nanoseconds) for php is 17,650,035
    time elapsed (nanoseconds) for node is 5,513,095
    list size: 600
    time elapsed (nanoseconds) for php is 25,876,427
    time elapsed (nanoseconds) for node is 5,850,769
    list size: 700
    time elapsed (nanoseconds) for php is 36,529,920
    time elapsed (nanoseconds) for node is 6,081,779
    list size: 800
    time elapsed (nanoseconds) for php is 44,227,545
    time elapsed (nanoseconds) for node is 6,228,818
    list size: 900
    time elapsed (nanoseconds) for php is 57,408,295
    time elapsed (nanoseconds) for node is 6,694,652
    list size: 1000
    time elapsed (nanoseconds) for php is 72,854,544
    time elapsed (nanoseconds) for node is 7,116,747

### Run HTTP Tests

    make test/web

    Server Software:        nginx/1.16.0
    Server Hostname:        php
    Server Port:            80
    
    Document Path:          /
    Document Length:        Variable
    
    Concurrency Level:      10
    Time taken for tests:   0.306 seconds
    Complete requests:      1000
    Failed requests:        0
    Total transferred:      487000 bytes
    Total body sent:        4020000
    HTML transferred:       325000 bytes
    Requests per second:    3270.65 [#/sec] (mean)
    Time per request:       3.058 [ms] (mean)
    Time per request:       0.306 [ms] (mean, across all concurrent requests)
    Transfer rate:          1555.47 [Kbytes/sec] received
                            12839.84 kb/s sent
                            14395.31 kb/s total
    
    Server Software:        
    Server Hostname:        node
    Server Port:            80
    
    Document Path:          /
    Document Length:        Variable
    
    Concurrency Level:      10
    Time taken for tests:   2.435 seconds
    Complete requests:      1000
    Failed requests:        0
    Total transferred:      82000 bytes
    Total body sent:        4021000
    HTML transferred:       7000 bytes
    Requests per second:    410.73 [#/sec] (mean)
    Time per request:       24.347 [ms] (mean)
    Time per request:       2.435 [ms] (mean, across all concurrent requests)
    Transfer rate:          32.89 [Kbytes/sec] received
                            1612.85 kb/s sent
                            1645.74 kb/s total