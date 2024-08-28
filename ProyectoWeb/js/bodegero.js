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
        $('#formulario').hide(); // Oculta el formulario de ingreso
        $('#productos-lista').show(); // Muestra la lista de productos
        $('#productos-lista tbody').empty(); // Limpia la tabla antes de cargar nuevos datos

        // Cargar productos
        $.get('../php/listarproductos.php', function(data) {
            $('#productos-lista tbody').html(data); // Agrega los productos a la tabla
        });
    });

    // Función para agregar un producto
    $('#product-form').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío del formulario por defecto
        agregarProducto();
    });
	
// Manejador del buscador de productos
$('#buscador-productos').on('keyup', function() {
    listarProductos(); // Actualiza la lista de productos con el término de búsqueda
});
;


	

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
    const searchTerm = $('#buscador-productos').val(); // Obtener el término de búsqueda
    $.ajax({
        url: '../php/listarproductos.php?search=' + encodeURIComponent(searchTerm), // Pasar el término de búsqueda
        type: 'GET',
        success: function(response) {
            $('#productos-lista tbody').html(response); // Llenar solo el tbody
            $('#productos-lista').show(); // Mostrar la lista de productos
        },
        error: function() {
            $('#productos-lista tbody').html('<tr><td colspan="8">Error al cargar la lista de productos.</td></tr>');
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
