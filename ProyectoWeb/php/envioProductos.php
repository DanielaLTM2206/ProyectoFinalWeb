<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'conexion.php'; // Asegúrate de que la ruta sea correcta

// Crear una instancia de la conexión a la base de datos
$db = new DatabaseConnection();
$conn = $db->conn;

$response = array();

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
        $response["success"] = false;
        $response["message"] = "Todos los campos son obligatorios.";
        echo json_encode($response);
        exit;
    }

    if ($precioUnitario < 0 || $cantidad < 1 || ($precioVenta !== null && $precioVenta < 0)) {
        $response["success"] = false;
        $response["message"] = "El precio unitario, la cantidad y el precio de venta deben ser valores positivos, y la cantidad debe ser mayor o igual a 1.";
        echo json_encode($response);
        exit;
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
        $response["success"] = false;
        $response["message"] = "Error en la preparación de la consulta: " . $conn->error;
        echo json_encode($response);
        exit;
    }

    $stmt->bind_param("ssissssi", $codigo, $nombre, $precioUnitario, $cantidad, $categoria, $fechaIngreso, $detalle, $precioVenta);

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Datos almacenados correctamente.";
    } else {
        $response["success"] = false;
        $response["message"] = "Error al almacenar los datos: " . $stmt->error;
    }

    $stmt->close();
    $db->closeConnection();
    
    echo json_encode($response);
}
?>
