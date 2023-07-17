<?php
session_start();

// Verificar si no hay una sesión activa
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


// Cerrar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>MOSTRAR USUARIOS</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/styleTable.css">


</head>
<body>
    <a class="atras-si" href="../inicio.php">Volver</a>
    <table id="tablaUsuarios">
  <tr>
    <th>ID</th>
    <th>USUARIO</th>
    <th>CONTRASEÑA</th>
    <th>ROL (1=admin, 0=usuario)</th>
    <th>Acciones</th>
  </tr>
  <script src="../js/eliminar.js"></script>
  <script src="../js/editar.js"></script>
  <script src="../js/crearUsuario.js"></script>
  <?php
// Conexión a la base de datos SQLite
$db = new SQLite3('../db/user.db'); 

// Verificar si la conexión es exitosa
if (!$db) {
    die("Error al conectar con la base de datos.");
}

// Consulta SQL para obtener los datos de la tabla
$query = "SELECT * FROM users";

// Ejecutar la consulta y obtener los resultados
$result = $db->query($query);

// Verificar si se obtuvieron resultados
if ($result) {

    // Recorrer los resultados y generar las filas de la tabla
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['idUser'] . "</span></td>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['username'] . "</span></td>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['password'] . "</span></td>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['role'] . "</span></td>";
        echo "<td>";
        
        // Verificar si es la primera fila (administrador)
        if ($row['idUser'] == 1) {
            // No mostrar botones de edición y eliminación para el administrador
            echo "Owner";
        } else {
            // Mostrar botones de edición y eliminación para otros usuarios
            echo "<span class='editar' data-id='" . $row['idUser'] . "' onclick='makeEditable(this)'><i class='fas fa-edit'></i></span>";
            echo "<span class='guardar' data-id='" . $row['idUser'] . "' onclick='saveChanges(this)'><i class='fas fa-save'></i></span>";
            echo "<span class='eliminar' data-id='" . $row['idUser'] . "' onclick='eliminarUsuario(this)'><i class='fas fa-trash'></i></span>";
        }
        
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    // Error al ejecutar la consulta
    echo "Error al obtener los datos de la tabla: " . $db->lastErrorMsg();
}

// Cerrar la conexión a la base de datos
$db->close();
?>



</table>
<button id="btnAgregarUsuario" onclick="addUser()"><i class="fas fa-plus"></i> </button>
</body>
</html>
