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
        // Conectar a la base de datos MySQLi
        $conexion = mysqli_connect("localhost", "root", "", "user");

        // Verificar la conexión a la base de datos
        if (mysqli_connect_errno()) {
            die("Error al conectar a la base de datos: " . mysqli_connect_error());
        }

        // Escapar los valores para evitar inyección de SQL
        $username = mysqli_real_escape_string($conexion, $username);
        $password = mysqli_real_escape_string($conexion, $password);

        // Consultar la base de datos para verificar las credenciales y el rol
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conexion, $query);

        // Obtener el número de filas del resultado de la consulta
        $row_count = mysqli_num_rows($result);

        if ($row_count == 1) {
            // Inicio de sesión exitoso
            $_SESSION['username'] = $username;

            // Obtener el rol del usuario
            $row = mysqli_fetch_assoc($result);
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

        // Liberar el resultado de la consulta y cerrar la conexión a la base de datos
        mysqli_free_result($result);
        mysqli_close($conexion);
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