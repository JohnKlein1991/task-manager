function validateEmail(e) {
    let email = e.currentTarget.value;
    let reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if(reg.test(email) == false) {
        setError(e.target.parentNode, 'Введите корректный e-mail');
        return false;
    }
}

function setError(htmlNode, errorText) {
    htmlNode.dataset.error = errorText;
}