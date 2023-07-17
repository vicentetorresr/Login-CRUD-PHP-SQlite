<?php
session_start();

// Verificar si se está accediendo directamente al archivo
$filename = basename($_SERVER['PHP_SELF']);

if ($filename === "inicio.php" || $filename === "mostrarUsuarios.php") {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar los campos
    if (empty($username) || empty($password)) {
        $error = "Por favor, complete todos los campos.";
    } else {
        // Conexión a la base de datos SQLite
        $db = new SQLite3('../db/user.db');

        // Escapar los valores para evitar inyección de SQL (NO necesario para SQLite)
        // $username = SQLite3::escapeString($username);
        // $password = SQLite3::escapeString($password);

        // Consultar la base de datos para verificar las credenciales y el rol
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $db->query($query);

        // Obtener el número de filas del resultado de la consulta
        $row_count = 0;
        while ($row = $result->fetchArray()) {
            $row_count++;
        }

        if ($row_count == 1) {
            // Inicio de sesión exitoso
            $_SESSION['username'] = $username;

            // Obtener el rol del usuario
            $result->reset();
            $row = $result->fetchArray(SQLITE3_ASSOC);
            $role = intval($row['role']);

            // Redireccionar al dashboard correspondiente
            if ($role !== 1) {
                header("Location: ../user/user.php");
            } else {
                header("Location: ../inicio.php");
            }
            exit;
        } else {
            // Credenciales inválidas
            $error = "Credenciales inválidas.";
        }

        // Cerrar la conexión a la base de datos
        $db->close();
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Inicio de sesión</title>
</head>
<body>
    <div class="container">
        <h2>Inicio de sesión</h2>
        <style>
    .error {
        color: white;
    }
</style>
        <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="Iniciar sesión">
            <a href="../registrarse.html">No tienes una cuenta?</a>
        </form>
    </div>
</body>
</html>