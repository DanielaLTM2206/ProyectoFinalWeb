<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtención de datos del formulario
    $productCode = $_POST['productCode'];
    $precioVenta = $_POST['precioVenta'];

    // Validación básica
    if (empty($productCode) || empty($precioVenta)) {
        die("Todos los campos son obligatorios.");
    }

    if ($precioVenta < 0) {
        die("El precio de venta debe ser un valor positivo.");
    }

    // Actualización en la base de datos
    $sql = "UPDATE productos SET precioVenta = ? WHERE codigo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $precioVenta, $productCode);

    if ($stmt->execute()) {
        echo "Precio de venta actualizado con éxito.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
