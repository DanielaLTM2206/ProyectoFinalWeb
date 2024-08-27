document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Previene que el formulario se envíe de manera tradicional

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorDiv = document.getElementById('error');

    // Aquí podrías agregar la lógica para validar las credenciales
    if (username === 'admin' && password === '1234') {
        // Redirigir al panel principal si las credenciales son correctas
        window.location.href = 'html/menu.html';
    } else {
        // Mostrar un mensaje de error si las credenciales son incorrectas
        errorDiv.textContent = 'Usuario o contraseña incorrectos. Inténtalo de nuevo.';
    }
});
