$(document).ready(function() {
    // Cargar la lista de productos cuando se carga la página
    listarProductos();

    // Función para agregar un producto
    $('#product-form').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío del formulario por defecto
        agregarProducto();
    });

    // Función para listar productos
    $('#listarProductos').click(function(e) {
        e.preventDefault();
        listarProductos();
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
        dataType: 'json', // Asegúrate de recibir una respuesta en JSON
        success: function(data) {
            console.log(data); // Verifica la respuesta en la consola
            if (data.success) {
                mostrarMensaje(data.message, 'success'); // Mostrar mensaje de éxito
                $('#product-form')[0].reset(); // Limpiar el formulario
                listarProductos(); // Actualizar la lista de productos
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
            console.log(response); // Verifica la respuesta en la consola
            $('#productos-lista').html(response);
        },
        error: function() {
            $('#productos-lista').html('Error al cargar la lista de productos.');
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
	
	// Ocultar el mensaje después de 3 segundos (3000 milisegundos)
    setTimeout(function() {
        mensajeDiv.fadeOut(); // Puedes usar fadeOut para un desvanecimiento suave
    }, 3000); // 3000 milisegundos = 3 segundos
}
