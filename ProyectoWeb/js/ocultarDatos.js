document.getElementById("usuariosLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormularioUsuarios();
});

document.getElementById("ingresarProductoLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormularioProductos();
});

function mostrarFormularioUsuarios() {
    var usuarioForm = document.getElementById('usuarioFormContainer');
    var productoForm = document.getElementById('productoFormContainer');
    
    // Oculta el formulario de productos si está visible
    productoForm.style.display = 'none';
    
    // Muestra u oculta el formulario de usuarios
    if (usuarioForm.style.display === 'none' || usuarioForm.style.display === '') {
        usuarioForm.style.display = 'block';
    } else {
        usuarioForm.style.display = 'none';
    }
}

function mostrarFormularioProductos() {
    var productoForm = document.getElementById('productoFormContainer');
    var usuarioForm = document.getElementById('usuarioFormContainer');
    
    // Oculta el formulario de usuarios si está visible
    usuarioForm.style.display = 'none';
    
    // Muestra u oculta el formulario de productos
    if (productoForm.style.display === 'none' || productoForm.style.display === '') {
        productoForm.style.display = 'block';
    } else {
        productoForm.style.display = 'none';
    }
}
