<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "productos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar variables
$errors = [];
$pronombre = $precio = $cantidad = $categoria = "";

// Validar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pronombre = trim($_POST['pronombre']);
    $precio = trim($_POST['precio']);
    $cantidad = trim($_POST['cantidad']);
    $categoria = trim($_POST['categoria']);
    
    // Validaciones básicas
    if (empty($pronombre) || empty($precio) || empty($cantidad) || empty($categoria)) {
        $errors[] = "Todos los campos son obligatorios.";
    }
    
    if (!is_numeric($precio) || $precio <= 0) {
        $errors[] = "El precio debe ser un valor numérico positivo.";
    }
    
    if (!is_numeric($cantidad) || $cantidad <= 0) {
        $errors[] = "La cantidad debe ser un valor numérico positivo.";
    }
    
    // Verificar si hay errores antes de intentar almacenar los datos
    if (empty($errors)) {
        // Preparar y vincular
        $stmt = $conn->prepare("INSERT INTO datosproductos (pronombre, precio, cantidad, categoria) VALUES (?, ?, ?, ?)");
        
        if ($stmt === false) {
            die("Error en la preparación de la declaración: " . $conn->error);
        }
        
        $stmt->bind_param("sdss", $pronombre, $precio, $cantidad, $categoria);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>
                    alert('Datos almacenados correctamente...');
                    window.location.href = '../html/IngresarProductos.html';
                  </script>";
        } else {
            echo "<script>
                    alert('Error al almacenar los datos: " . $stmt->error . "');
                    window.location.href = '../html/IngresarProductos.html';
                  </script>";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        // Mostrar errores
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
        echo "<script>window.history.back();</script>"; // Regresar al formulario
    }
    
    // Cerrar la conexión
    $conn->close();
} else {
    echo "<script>window.history.back();</script>"; // Regresar al formulario si no es POST
}
?>
