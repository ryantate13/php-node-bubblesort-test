const bubbleSort = require('./bubble-sort-v2'),
    bodyParser = require('body-parser'),
    app = require('express')();

app.use(bodyParser.json());

app.post('*', (req, res) => {
    const start = process.hrtime.bigint();
    bubbleSort(req.body);
    const end = process.hrtime.bigint();
    res.end(String(end - start));
});

app.listen(80);