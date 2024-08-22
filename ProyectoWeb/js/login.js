document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario

    // Usuarios predefinidos
    const users = [
        { username: 'Axel', password: 'pass1', role: 'admin', redirectTo: 'html/admin.html' },
        { username: 'Alexis', password: 'pass2', role: 'bodeguero', redirectTo: 'html/bodegero.html' },
        { username: 'Dani', password: 'pass3', role: 'cliente', redirectTo: 'html/cliente.html' }
    ];

    // Obtener valores ingresados por el usuario
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Verificar si los datos coinciden con alguno de los usuarios predefinidos
    const user = users.find(user => user.username === username && user.password === password);

    const errorDiv = document.getElementById('error');

    if (user) {
        errorDiv.textContent = ''; // Limpiar mensaje de error
        alert(`Bienvenido ${user.username}, rol: ${user.role}`);
        window.location.href = user.redirectTo; // Redirigir a la página correspondiente
    } else {
        errorDiv.textContent = 'Usuario o contraseña incorrectos.';
    }
});
