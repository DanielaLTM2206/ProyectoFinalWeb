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

// Verifica si se ha enviado un término de búsqueda
$searchTerm = $_GET['search'] ?? '';

// Consulta para obtener productos, con o sin filtro de búsqueda
$query = "SELECT * FROM productos";
if (!empty($searchTerm)) {
    $query .= " WHERE nombre LIKE ? LIMIT 1"; // Limitar a un solo resultado
}

$stmt = $conn->prepare($query);
if (!empty($searchTerm)) {
    $searchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("s", $searchTerm);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr><th>Código</th><th>Nombre</th><th>Precio Unitario</th><th>Cantidad</th><th>Categoría</th><th>Fecha de Ingreso</th><th>Descripción</th><th>Acciones</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['codigo']."</td>";
        echo "<td>".$row['nombre']."</td>";
        echo "<td>".$row['precioUnitario']."</td>";
        echo "<td>".$row['cantidad']."</td>";
        echo "<td>".$row['categoria']."</td>";
        echo "<td>".$row['fechaIngreso']."</td>";
        echo "<td>".$row['detalle']."</td>";
        echo "<td><a href='actualizarproducto.php?id=".$row['codigo']."'>Editar</a><br><a href='borrarproducto.php?id=".$row['codigo']."'>Eliminar</a></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "No hay productos disponibles.";
}

// Cerrar la conexión
$db->closeConnection();
?>
