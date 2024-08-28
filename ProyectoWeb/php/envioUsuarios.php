<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "ferreteria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar variables
$errors = [];
$usuario = $contraseña = $rol = $nombre= $apellido = $descripcion = $accesos = "";

// Validar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $contraseña = trim($_POST['contraseña']);
    $rol = trim($_POST['rol']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $descripcion = trim($_POST['descripcion']);
    $accesos = trim($_POST['accesos']);

    
    // Verificar si hay errores antes de intentar almacenar los datos
    if (empty($errors)) {
        // Preparar y vincular
        $stmt = $conn->prepare("INSERT INTO credenciales (usuario, contraseña, rol, nombre, apellido, descripcion, accesos) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            die("Error en la preparación de la declaración: " . $conn->error);
        }
        
        $stmt->bind_param("sssssss", $usuario, $contraseña, $rol, $nombre, $apellido, $descripcion, $accesos);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>
                    alert('Datos almacenados correctamente...');
                    window.location.href = '../html/admin.html';
                  </script>";
        } else {
            echo "<script>
                    alert('Error al almacenar los datos: " . $stmt->error . "');
                    window.location.href = '../html/admin.html';
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