<?php
// Obtener los datos enviados por la solicitud POST
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
$username = mysqli_real_escape_string($conexion, $username);
$password = mysqli_real_escape_string($conexion, $password);
$role = mysqli_real_escape_string($conexion, $role);

// Insertar el nuevo usuario en la base de datos
$query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
if (mysqli_query($conexion, $query)) {
    // Inserción exitosa
    header("Location: ../mostrarUsuarios.php");
    exit;
} else {
    // Error al insertar el usuario
    $error = "Error al registrar el usuario: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
