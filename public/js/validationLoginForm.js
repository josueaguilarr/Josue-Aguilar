import fetchAction from "./fetchAction.js";

const loginForm = document.getElementById('login-form');

loginForm.addEventListener('submit', async (e) => {
    e.preventDefault()
    
    if (loginForm.checkValidity()) {
        const login = await fetchAction(e.target, 'POST', 'UserController.php', 'login')
        
        if (login.success) {
            window.location.href = './dashboard.php'
        } else {
            alert(login.message)
        }
        
    } else {
        showErrors(e)
    }
});

function showErrors(e) {
    e.stopPropagation()
    loginForm.classList.add('was-validated')
}
