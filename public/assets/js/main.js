const passwordField = document.getElementById('floatingInputPassword');
const passwordField2 = document.getElementById('floatingInputPassword2');
const togglePassword = document.getElementById('togglePassword');
const togglePassword2 = document.getElementById('togglePassword2');
const terbuka = document.getElementById('terbuka');
const tertutup = document.getElementById('tertutup');
const terbuka2 = document.getElementById('terbuka2');
const tertutup2 = document.getElementById('tertutup2');

togglePassword.addEventListener('click', function () {
if (terbuka.style.display === 'none') {
    terbuka.style.display = 'block';
    tertutup.style.display = 'none';
    passwordField.type = 'text';
} else {
    terbuka.style.display = 'none';
    tertutup.style.display = 'block';
    passwordField.type = 'password';
}
});

togglePassword2.addEventListener('click', function () {
    if (terbuka2.style.display === 'none') {
        terbuka2.style.display = 'block';
        tertutup2.style.display = 'none';
        passwordField2.type = 'text';
    } else {
        terbuka2.style.display = 'none';
        tertutup2.style.display = 'block';
        passwordField2.type = 'password';
    }
});
