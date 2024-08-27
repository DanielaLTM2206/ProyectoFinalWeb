<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'conexion.php'; // Asegúrate de que la ruta sea correcta

// Crear una instancia de la conexión a la base de datos
$db = new DatabaseConnection();
$conn = $db->conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtención de datos del formulario
    $nombre = $_POST['nombre'] ?? null;
    $precioUnitario = $_POST['precioUnitario'] ?? null;
    $cantidad = $_POST['cantidad'] ?? null;
    $categoria = $_POST['categoria'] ?? null;
    $detalle = $_POST['detalle'] ?? null;
    $fechaIngreso = $_POST['fechaIngreso'] ?? null;
    $precioVenta = $_POST['precioVenta'] ?? null;

    // Validación básica
    if (empty($nombre) || empty($precioUnitario) || empty($cantidad) || empty($categoria) || empty($detalle) || empty($fechaIngreso)) {
        die("Todos los campos son obligatorios.");
    }

    if ($precioUnitario < 0 || $cantidad < 1 || ($precioVenta !== null && $precioVenta < 0)) {
        die("El precio unitario, la cantidad y el precio de venta deben ser valores positivos, y la cantidad debe ser mayor o igual a 1.");
    }

    // Generar un código único para el producto
    $codigo = uniqid('prod_');

    // Si el usuario es un bodeguero, no se debe ingresar el precioVenta
    if (!isset($_POST['es_admin']) || $_POST['es_admin'] !== 'true') {
        $precioVenta = null; // Asignar null si no está disponible
    }

    // Inserción en la base de datos
    $sql = "INSERT INTO productos (codigo, nombre, precioUnitario, cantidad, categoria, fechaIngreso, detalle, precioVenta) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssissssi", $codigo, $nombre, $precioUnitario, $cantidad, $categoria, $fechaIngreso, $detalle, $precioVenta);

    if ($stmt->execute()) {
        echo "Producto agregado con éxito.";
    } else {
        echo "Error en la inserción: " . $stmt->error;
    }

    $stmt->close();
    $db->closeConnection();
}
?>
