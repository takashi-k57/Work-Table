const changeHoliday = (event, oldvalue) => {

    const valueSelectors = [
        {
            value: '有',
            selector: '.yukyu'
        }, 
        {
            value: '公',
            selector: '.kokyu'
        },
        {
            value: '代',
            selector: '.daikyu'
        },
    ];

    const select = event.target;
    const tr = select.closest('tr');
    const newvalue = select.value;

    for (const valueSelector of valueSelectors) {
        const selector = valueSelector.selector;
        const target = tr.querySelector(selector);

        if (valueSelector.value == oldvalue) {
            target.textContent = Number(target.textContent) - 1;
        }
        if (valueSelector.value == newvalue) {
            target.textContent = Number(target.textContent) + 1;
        }
    }
}

export { changeHoliday };