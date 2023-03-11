// Chart Counters
    let counter = document.querySelectorAll('.stats p');
    counter.forEach((c) => count(c));
    function count (el) {
        let goal = el.dataset.goal;
        let increase = setInterval(() => {
            if (goal!=0) {
                el.textContent++;
                if (el.textContent == goal) {
                    clearInterval(increase);
                }
            }
        }, 500/goal);
    }
//END Chart Counters