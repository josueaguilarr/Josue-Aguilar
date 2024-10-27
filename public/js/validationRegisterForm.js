import fetchAction from "./fetchAction.js";

const registerForm = document.getElementById('register-form');
const inputs = document.querySelectorAll('input, textarea')

registerForm.addEventListener('submit', async (e) => {
    e.preventDefault()
    
    validatePasswords();
    
    if (registerForm.checkValidity()) {
        const register = await fetchAction(e.target, 'POST', 'UserController.php', 'store')
        
        alert(register.message)

        if (register.success) window.location.href = './register.html';
    } else {
        showErrors(e)
    }
});

inputs.forEach(input => {
    input.addEventListener('blur', () => input.checkValidity())
})

function validatePasswords() {
    const message = passwordMatch() ? '' : 'Las contraseñas no coinciden';
    const passwordFields = [document.getElementById('password'), document.getElementById('confirm-password')];

    passwordFields.forEach(field => {
        field.setCustomValidity(message);
        document.getElementById(`feedback-${field.id}`).innerHTML = message;
    });
}

function showErrors(e) {
    e.stopPropagation()
    registerForm.classList.add('was-validated')
}

function passwordMatch() {
    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('confirm-password').value;

    return password === confirmPassword
}