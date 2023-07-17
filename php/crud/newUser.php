<?php
// Obtener los datos enviados por la solicitud POST
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Conexión a la base de datos SQLite
$db = new SQLite3('../../db/user.db');

// Insertar el nuevo usuario en la base de datos
$query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
if ($db->exec($query)) {
    // Inserción exitosa
    header("Location: ../mostrarUsuarios.php");
    exit;
} else {
    // Error al insertar el usuario
    $error = "Error al registrar el usuario: " . $db->lastErrorMsg();
}

// Cerrar la conexión a la base de datos
$db->close();
?>
