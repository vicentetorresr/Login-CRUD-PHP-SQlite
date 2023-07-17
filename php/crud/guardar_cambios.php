<?php
// Obtener los datos enviados por la solicitud POST
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Conexión a la base de datos MySQLi
$conexion = mysqli_connect("localhost", "root", "", "user");

// Verificar la conexión a la base de datos
if (mysqli_connect_errno()) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Escapar los valores para evitar ataques de inyección SQL
$id = mysqli_real_escape_string($conexion, $id);
$username = mysqli_real_escape_string($conexion, $username);
$password = mysqli_real_escape_string($conexion, $password);
$role = mysqli_real_escape_string($conexion, $role);

// Actualizar los datos en la tabla
$query = "UPDATE users SET username = '$username', password = '$password', role = '$role' WHERE idUser = '$id'";
if (mysqli_query($conexion, $query)) {
    // Cambios guardados correctamente
    echo "Cambios guardados correctamente";
    header("Location: ../mostrarUsuarios.php");
    exit;
} else {
    // Error al actualizar los datos
    $error = "Error al guardar los cambios: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
