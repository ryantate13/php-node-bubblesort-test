const bubbleSort = (a) => {
    const len = a.length - 1;
    let sorted = false;

    while (!sorted) {
        sorted = true;
        for (let i = 0; i < len; i++) {
            let current = a[i];
            let next = a[i + 1];

            if (next < current) {
                a[i] = next;
                a[i + 1] = current;
                sorted = false;
            }
        }
    }
};

module.exports = bubbleSort;