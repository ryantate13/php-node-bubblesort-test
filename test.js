const bubbleSort = require('./bubble-sort-v2');

const nums = require('./list.json');

const start = process.hrtime.bigint();

bubbleSort(nums);

const end = process.hrtime.bigint();

console.log(end - start);