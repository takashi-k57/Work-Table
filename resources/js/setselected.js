const setSelected = (input, select) => {
    const options = select.querySelectorAll('option');
    console.log(options);
    if (options.length) {
        const value = input.value;
        for (const option of options) {
            if (option.value == value) {
            option.setAttribute('selected', true);
            }
        }
    }
};

export { setSelected };