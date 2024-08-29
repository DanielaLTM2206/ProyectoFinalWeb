<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "ferreteria";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['rol'];
    $nombre = $_POST['nombre'];
    $accesos = implode(",", $_POST['accesos']); // Convertir array a cadena
    $descripcion = $_POST['descripcion'];

    $stmt = $conn->prepare("INSERT INTO credenciales (usuario, contraseña, rol, nombre, accesos, descripcion) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $usuario, $contraseña, $rol, $nombre, $accesos, $descripcion);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario registrado con éxito');</script>";
        echo "<script>window.location.href = '../html/admin.html';</script>";
    } else {
        echo "<script>alert('Error al registrar usuario');</script>";
        echo "<script>window.location.href = '../html/admin.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
