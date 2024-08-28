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
$query = "SELECT * FROM credenciales";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<tr><th>Id</th><th>Usuario</th><th>Contraseña</th><th>Rol</th><th>Nombre</th><th>Apellido</th><th>Descripción</th><th>Accesos</th><th>Estado</th><th>Acciones</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['usuario']."</td>";
        echo "<td>".$row['contraseña']."</td>";
        echo "<td>".$row['rol']."</td>";
        echo "<td>".$row['nombre']."</td>";
        echo "<td>".$row['apellido']."</td>";
        echo "<td>".$row['descripcion']."</td>";
        echo "<td>".$row['accesos']."</td>";
        echo "<td>".$row['estado']."</td>";
				echo "<td><a href='actualizarusuario.php'>Editar</a><br>
		<a href='php/borrarusuario.php'>Eliminar</a>
		</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No hay productos disponibles.";
}

// Cerrar la conexión
$db->closeConnection();
?>
