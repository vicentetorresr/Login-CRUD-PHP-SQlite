<?php
// Verificar si se proporcionó un ID válido
if (isset($_POST['id'])) {
    $userId = $_POST['id'];

    $conexion = mysqli_connect("localhost", "root", "", "user");
    if (!$conexion) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $query = "DELETE FROM users WHERE idUser = '$userId'";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        // El usuario se eliminó exitosamente
        mysqli_close($conexion);
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
