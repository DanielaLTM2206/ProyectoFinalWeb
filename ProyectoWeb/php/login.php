<?php
$servername = "localhost";
$username = "admin"; // Cambia esto si tienes un usuario diferente
$password = "admin"; // Cambia esto si tienes una contraseña
$dbname = "ferreteria";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST['username'];
    $contraseña = $_POST['password'];

    // Preparar la consulta SQL para prevenir inyecciones SQL
    $stmt = $conn->prepare("SELECT rol FROM credenciales WHERE usuario = ? AND contraseña = ?");
    $stmt->bind_param("ss", $usuario, $contraseña);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows > 0) {
        // Obtener el rol del usuario
        $row = $result->fetch_assoc();
        $rol = $row['rol'];

        // Redirigir según el rol
        switch ($rol) {
            case 'admin':
                header("Location: ../html/admin.html");
                break;
            case 'vendedor':
                header("Location: ../vendedor.html");
                break;
            case 'bodeguero':
                header("Location: ../html/bodegero.html");
                break;
            case 'supervisor':
                header("Location: ../supervisor.html");
                break;
            case 'supersupervisor':
                header("Location: ../supersupervisor.html");
                break;
            default:
                echo "Rol no reconocido.";
                break;
        }
        exit();
    } else {
        // Inicio de sesión fallido
        echo "Usuario o contraseña incorrectos.";
    }

    $stmt->close();
    $conn->close();
}
?>