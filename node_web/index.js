const bubbleSort = require('./bubble-sort-v2');

require('http').createServer((req, res) => {
    let body = '';
    req.on('data', chunk => body += chunk.toString());
    req.on('end', () => {
        const list = JSON.parse(body);
        const start = process.hrtime.bigint();
        bubbleSort(list);
        const end = process.hrtime.bigint();
        res.end(String(end - start));
    });
}).listen(80);