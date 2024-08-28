<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexion.php'; // Asegúrate de que esta ruta sea correcta

// Crear una instancia de la clase de conexión
$db = new DatabaseConnection();
$conn = $db->conn; // Obtener la conexión

// Verifica si la conexión es válida
if ($conn === null) {
    die(json_encode(["success" => false, "message" => "La conexión a la base de datos no está establecida."]));
}

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $precioUnitario = $_POST['precioUnitario'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $fechaIngreso = $_POST['fechaIngreso'] ?? '';
    $detalle = $_POST['detalle'] ?? '';

    // Validar que no estén vacíos
    if (empty($nombre) || empty($precioUnitario) || empty($cantidad) || empty($categoria) || empty($fechaIngreso) || empty($detalle)) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
        exit;
    }

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("INSERT INTO productos (nombre, precioUnitario, cantidad, categoria, fechaIngreso, detalle) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdisss", $nombre, $precioUnitario, $cantidad, $categoria, $fechaIngreso, $detalle);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Producto agregado exitosamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al agregar el producto: " . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}

$db->closeConnection();
?>
