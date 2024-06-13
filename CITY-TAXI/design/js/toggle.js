function handleChange() {
    var statusElement = document.getElementById('status');
    var toggleSwitch = document.getElementById('toggle');

    if (toggleSwitch.checked) {
        statusElement.innerText = 'На смене';
    } else {
        statusElement.innerText = 'Не на смене';
    }
}