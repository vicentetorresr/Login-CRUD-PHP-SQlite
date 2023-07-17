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
$conexion = mysqli_connect("localhost", "root", "", "user");

// Verificar la conexión a la base de datos
if (mysqli_connect_errno()) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Consulta SQL para obtener los datos de la tabla
$query = "SELECT * FROM users";

// Ejecutar la consulta y obtener los resultados
$result = mysqli_query($conexion, $query);

// Verificar si se obtuvieron resultados
if ($result) {
    // Variable para controlar la primera fila
    $esPrimeraFila = true;
    
    // Recorrer los resultados y generar las filas de la tabla
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['idUser'] . "</span></td>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['username'] . "</span></td>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['password'] . "</span></td>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['role'] . "</span></td>";
        echo "<td>";
        
        // Verificar si es la primera fila (administrador)
        if ($esPrimeraFila) {
            // No mostrar botones de edición y eliminación
            echo "Owner";
        } else {
            // Mostrar botones de edición y eliminación
            echo "<span class='editar' data-id='" . $row['idUser'] . "' onclick='makeEditable(this)'><i class='fas fa-edit'></i></span>";
            echo "<span class='guardar' data-id='" . $row['idUser'] . "' onclick='saveChanges(this)'><i class='fas fa-save'></i></span>";
            echo "<span class='eliminar' data-id='" . $row['idUser'] . "' onclick='eliminarUsuario(this)'><i class='fas fa-trash'></i></span>";
        }
        
        echo "</td>";
        echo "</tr>";
        
        // Actualizar el valor de $esPrimeraFila después de la primera fila
        $esPrimeraFila = false;
    }

    // Liberar el resultado de la consulta
    mysqli_free_result($result);
} else {
    // Error al ejecutar la consulta
    echo "Error al obtener los datos de la tabla: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>


</table>
<button id="btnAgregarUsuario" onclick="addUser()"><i class="fas fa-plus"></i> </button>
</body>
</html>
