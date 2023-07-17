<?php
// Verificar si se proporcionó un ID válido
if (isset($_POST['id'])) {
    $userId = $_POST['id'];

    // Conexión a la base de datos SQLite
    $db = new SQLite3('../../db/user.db');

    // Consultar la base de datos para eliminar el usuario
    $query = "DELETE FROM users WHERE idUser = '$userId'";
    $result = $db->exec($query);

    if ($result !== false) {
        // El usuario se eliminó exitosamente
        $db->close();
        header("Location: ../mostrarUsuarios.php");
        exit;
    } else {
        // Ocurrió un error al eliminar el usuario
        echo "Error al eliminar el usuario";
    }
} else {
    // No se proporcionó un ID válido
    echo "ID de usuario no válido";
}
?>
