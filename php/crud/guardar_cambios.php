<?php
// Obtener los datos enviados por la solicitud POST
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Conexión a la base de datos SQLite
$db = new SQLite3('../../db/user.db');

// Escapar los valores para evitar ataques de inyección SQL (NO necesario para SQLite)
// $id = SQLite3::escapeString($id);
// $username = SQLite3::escapeString($username);
// $password = SQLite3::escapeString($password);
// $role = SQLite3::escapeString($role);

// Actualizar los datos en la tabla
$query = "UPDATE users SET username = '$username', password = '$password', role = '$role' WHERE idUser = '$id'";
if ($db->exec($query)) {
    // Cambios guardados correctamente
    echo "Cambios guardados correctamente";
    header("Location: ../mostrarUsuarios.php");
    exit;
} else {
    // Error al actualizar los datos
    $error = "Error al guardar los cambios: " . $db->lastErrorMsg();
}

// Cerrar la conexión a la base de datos
$db->close();
?>
