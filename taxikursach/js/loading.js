function sendForm() {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', document.forms.user.action);
    xhr.responseType = 'json';
    xhr.onload = () => {
    document.forms.user.querySelector('[type="submit"]').disabled = false;
    document.forms.user.querySelector('.submit-spinner').classList.add('submit-spinner_hide');
    if (xhr.status !== 200) {
        return;
    }
    const response = xhr.response;
    }
    xhr.onerror = () => {
    document.forms.user.querySelector('[type="submit"]').disabled = false;
    document.forms.user.querySelector('.submit-spinner').classList.add('submit-spinner_hide');
    };
    let formData = new FormData(document.forms.user);
    document.forms.user.querySelector('[type="submit"]').disabled = true;
    document.forms.user.querySelector('.submit-spinner').classList.remove('submit-spinner_hide');
    xhr.send(formData);
}
// при отправке формы
document.forms.user.addEventListener('submit', (e) => {
    e.preventDefault();
    sendForm();
});