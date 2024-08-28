document.getElementById("usuariosLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormulario('usuarioFormContainer');
});

document.getElementById("ingresarProductoLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormulario('productoFormContainer');
});

document.getElementById("listarProductoLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormulario('productos-lista');
});

document.getElementById("listarUsuarioLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormulario('usuarios-lista');
});

document.getElementById("actualizarProductoLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormulario('actualizarFormContainer');
});

document.getElementById("buscarProductoLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormulario('buscarFormContainer');
});


document.getElementById("clientesLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormulario('clientesFormContainer');
});

document.getElementById("proveedoresLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormulario('proveedoresFormContainer');
});

document.getElementById("reportesLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormulario('reportesFormContainer');
});


function mostrarFormulario(idFormulario) {
    // Ocultar todos los formularios
    var formularios = document.querySelectorAll('#main-content > div');
    formularios.forEach(function(formulario) {
        formulario.style.display = 'none';
    });

    // Mostrar el formulario seleccionado
    var formularioSeleccionado = document.getElementById(idFormulario);
    if (formularioSeleccionado) {
        formularioSeleccionado.style.display = 'block';
    }
}

$(document).ready(function() {
    $('#listarProductoLink').click(function(e) {
        e.preventDefault();
        $('#productos-lista').show(); // Mostrar el contenedor
        listarProductos(); // Cargar la lista de productos
    });
});

$(document).ready(function() {
    $('#listarUsuarioLink').click(function(e) {
        e.preventDefault();
        $('#usuarios-lista').show(); // Mostrar el contenedor
        listarUsuarios(); // Cargar la lista de productos
    });
});


function listarProductos() {
    $.ajax({
        url: '../php/listarproductos.php',
        type: 'GET',
        success: function(response) {
            console.log(response); // Verifica la respuesta en la consola
            $('#productos-lista').html(response).show(); // Mostrar la lista de productos
        },
        error: function() {
            $('#productos-lista').html('Error al cargar la lista de productos.').show();
        }
    });
}

function listarUsuarios() {
    $.ajax({
        url: '../php/listarusuarios.php',
        type: 'GET',
        success: function(response) {
            console.log(response); // Verifica la respuesta en la consola
            $('#usuarios-lista').html(response).show(); // Mostrar la lista de productos
        },
        error: function() {
            $('#usuarios-lista').html('Error al cargar la lista de usuarios.').show();
        }
    });
}
