$(document).ready(function() {
    // Mostrar el formulario de ingreso al cargar la página
    $('#formulario').show();
    $('#productos-lista').hide();

    // Manejador de clic para "Ingresar Producto"
    $('#ingresarProducto').click(function(e) {
        e.preventDefault();
        $('#formulario').show();
        $('#productos-lista').hide();
    });

    // Manejador de clic para "Listar productos"
    $('#listarProductos').click(function(e) {
        e.preventDefault();
        $('#formulario').hide();
        $('#productos-lista').show();
        listarProductos(); // Cargar la lista de productos
    });

    // Función para agregar un producto
    $('#product-form').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío del formulario por defecto
        agregarProducto();
    });
});

function agregarProducto() {
    if (!validarFormulario()) {
        mostrarMensaje('Por favor, complete todos los campos.', 'error');
        return;
    }

    var formData = $('#product-form').serialize(); // Serializa todos los datos del formulario

    $.ajax({
        url: '../php/envioProductos.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log(response);
            const data = JSON.parse(response); // Parsear la respuesta JSON
            if (data.success) {
                mostrarMensaje(data.message, 'success'); // Mostrar mensaje de éxito
                $('#product-form')[0].reset(); // Limpiar el formulario
                $('#productos-lista').hide(); // Ocultar lista de productos si estaba visible
            } else {
                mostrarMensaje(data.message, 'error'); // Mostrar mensaje de error
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown);
            mostrarMensaje('Error al enviar los datos.', 'error');
        }
    });
}

function listarProductos() {
    $.ajax({
        url: '../php/listarproductos.php', // Asegúrate de que esta URL esté correctamente configurada
        type: 'GET',
        success: function(response) {
            console.log(response);
            $('#productos-lista').html(response).show(); // Mostrar la lista de productos
        },
        error: function() {
            $('#productos-lista').html('Error al cargar la lista de productos.').show();
        }
    });
}

function validarFormulario() {
    return $('#nombre').val() && $('#precioUnitario').val() && $('#cantidad').val() && $('#categoria').val() && $('#fechaIngreso').val() && $('#detalle').val();
}

// Función para mostrar mensajes
function mostrarMensaje(mensaje, tipo) {
    const mensajeDiv = $('#mensaje');
    mensajeDiv.text(mensaje);
    mensajeDiv.removeClass('success-message error-message'); // Limpiar clases anteriores
    mensajeDiv.addClass(tipo === 'success' ? 'success-message' : 'error-message'); // Agregar clase según el tipo
    mensajeDiv.show(); // Mostrar el mensaje
    setTimeout(function() {
        mensajeDiv.hide(); // Ocultar el mensaje después de un tiempo
    }, 3000);
}
