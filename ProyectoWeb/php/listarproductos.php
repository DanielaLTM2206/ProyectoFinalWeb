<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexion.php'; // Asegúrate de que esta ruta sea correcta

// Crear una instancia de la clase de conexión
$db = new DatabaseConnection();
$conn = $db->conn; // Obtener la conexión

// Verifica si la conexión es válida
if ($conn === null) {
    die("La conexión a la base de datos no está establecida.");
}

// Consulta para obtener productos
$query = "SELECT * FROM productos";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<tr><th>Código</th><th>Nombre</th><th>Precio Unitario</th><th>Cantidad</th><th>Categoría</th><th>Fecha de Ingreso</th><th>Descripción</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['codigo']."</td>";
        echo "<td>".$row['nombre']."</td>";
        echo "<td>".$row['precioUnitario']."</td>";
        echo "<td>".$row['cantidad']."</td>";
        echo "<td>".$row['categoria']."</td>";
        echo "<td>".$row['fechaIngreso']."</td>";
        echo "<td>".$row['detalle']."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No hay productos disponibles.";
}

// Cerrar la conexión
$db->closeConnection();
?>
