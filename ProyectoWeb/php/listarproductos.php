<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexion.php'; // Asegúrate de que esta ruta sea correcta

$db = new DatabaseConnection();
$conn = $db->conn;

if ($conn === null) {
    die("La conexión a la base de datos no está establecida.");
}

// Procesar eliminación de producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'delete') {
        $id = $_POST['codigo'] ?? '';
        if (!empty($id)) {
            $stmt = $conn->prepare("DELETE FROM productos WHERE codigo = ?");
            $stmt->bind_param("s", $id);
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Producto eliminado exitosamente.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el producto.']);
            }
            $stmt->close();
        }
        exit;
    }

    if ($_POST['action'] === 'update') {
        $codigo = $_POST['codigo'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $precioUnitario = $_POST['precioUnitario'] ?? '';
        $cantidad = $_POST['cantidad'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        $fechaIngreso = $_POST['fechaIngreso'] ?? '';
        $detalle = $_POST['detalle'] ?? '';

        if (empty($nombre) || empty($precioUnitario) || empty($cantidad) || empty($categoria) || empty($fechaIngreso) || empty($detalle)) {
            echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
            exit;
        }

        $stmt = $conn->prepare("UPDATE productos SET nombre = ?, precioUnitario = ?, cantidad = ?, categoria = ?, fechaIngreso = ?, detalle = ? WHERE codigo = ?");
        $stmt->bind_param("sdissss", $nombre, $precioUnitario, $cantidad, $categoria, $fechaIngreso, $detalle, $codigo);
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Producto actualizado exitosamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el producto.']);
        }
        
        $stmt->close();
        exit;
    }
}

// Obtener la lista de productos
$searchTerm = $_GET['search'] ?? '';
if ($searchTerm) {
    $stmt = $conn->prepare("SELECT * FROM productos WHERE nombre LIKE ?");
    $searchParam = "%" . $searchTerm . "%";
    $stmt->bind_param("s", $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM productos");
}

$productos = [];
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar y Eliminar Productos</title>
    <link href="../css/estilo.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="main-content">
        <h2>Editar y Eliminar Productos</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Categoría</th>
                    <th>Fecha de Ingreso</th>
                    <th>Detalles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr data-codigo="<?php echo $producto['codigo']; ?>">
                        <td><?php echo $producto['codigo']; ?></td>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td><?php echo $producto['precioUnitario']; ?></td>
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td><?php echo $producto['categoria']; ?></td>
                        <td><?php echo $producto['fechaIngreso']; ?></td>
                        <td><?php echo $producto['detalle']; ?></td>
                        <td>
                            <button class="edit-btn">Editar</button>
                            <button class="delete-btn">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        


    </div>

    <script>
        $(document).ready(function() {
            // Editar producto
            $(document).on('click', '.edit-btn', function() {
                const row = $(this).closest('tr');
                const codigo = row.data('codigo');
                const nombre = row.find('td:nth-child(2)').text();
                const precioUnitario = row.find('td:nth-child(3)').text();
                const cantidad = row.find('td:nth-child(4)').text();
                const categoria = row.find('td:nth-child(5)').text();
                const fechaIngreso = row.find('td:nth-child(6)').text();
                const detalle = row.find('td:nth-child(7)').text();
				
				 console.log(codigo, nombre, precioUnitario, cantidad, categoria, fechaIngreso, detalle); // Verifica los valores

                $('#codigo').val(codigo);
                $('#nombre').val(nombre);
                $('#precioUnitario').val(precioUnitario);
                $('#cantidad').val(cantidad);
                $('#categoria').val(categoria);
                $('#fechaIngreso').val(fechaIngreso);
                $('#detalle').val(detalle);
                $('#form-container').show();
            });

            // Eliminar producto
            $(document).on('click', '.delete-btn', function() {
                const row = $(this).closest('tr');
                const codigo = row.data('codigo');

                if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                    $.post('../php/listarproductos.php', { action: 'delete', codigo: codigo })
                        .done(function(response) {
                            const res = JSON.parse(response);
                            alert(res.message);
                            if (res.status === 'success') {
                                row.remove(); // Remover fila de la tabla
                            }
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            alert('Error: ' + textStatus + ' - ' + errorThrown);
                        });
                }
            });

            // Actualizar producto
            $('#update-form').submit(function(event) {
                event.preventDefault();
                $.post('../php/listarproductos.php', $(this).serialize() + '&action=update', function(response) {
                    const res = JSON.parse(response);
                    alert(res.message);
                    if (res.status === 'success') {
                        location.reload(); // Recargar la página para ver los cambios
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    alert('Error: ' + textStatus + ' - ' + errorThrown);
                });
            });
        });
    </script>
</body>
</html>

<?php
$db->closeConnection();
?>
