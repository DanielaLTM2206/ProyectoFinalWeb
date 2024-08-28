$(document).ready(function() {
    $('#formulario').show();
    $('#productos-lista').hide();

    $('#ingresarProducto').click(function(e) {
        e.preventDefault();
        $('#formulario').show();
        $('#productos-lista').hide();
    });

    $('#listarProductos').click(function(e) {
        e.preventDefault();
        $('#formulario').hide();
        $('#productos-lista').show();
        listarProductos(); // Cargar la lista de productos
    });

    $('#product-form').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío del formulario por defecto
        agregarProducto();
    });

    $('#buscador-productos').on('keyup', function() {
        listarProductos(); // Actualiza la lista de productos con el término de búsqueda
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
        dataType: 'json', // Asegúrate de que se espera un JSON
        success: function(data) {
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
    const searchTerm = $('#buscador-productos').val(); // Obtener el término de búsqueda
    $.ajax({
        url: '../php/listarproductos.php?search=' + encodeURIComponent(searchTerm), // Pasar el término de búsqueda
        type: 'GET',
        dataType: 'html', // Asegúrate de que se espera HTML
        success: function(response) {
            $('#productos-lista tbody').html(response); // Llenar solo el tbody
            $('#productos-lista').show(); // Mostrar la lista de productos
        },
        error: function() {
            $('#productos-lista tbody').html('<tr><td colspan="7">Error al cargar la lista de productos.</td></tr>');
            $('#productos-lista').show();
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
