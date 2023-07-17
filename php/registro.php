<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar los campos
    if (empty($username) || empty($password)) {
        $error = "Por favor, complete todos los campos.";
    } else {
        // Conexión a la base de datos MySQLi
        $conexion = mysqli_connect("localhost", "root", "", "user");

        // Verificar la conexión a la base de datos
        if (mysqli_connect_errno()) {
            die("Error al conectar a la base de datos: " . mysqli_connect_error());
        }

        // Escapar los valores para evitar ataques de inyección SQL
        $username = mysqli_real_escape_string($conexion, $username);
        $password = mysqli_real_escape_string($conexion, $password);

        // Consultar la base de datos para verificar si el usuario ya existe
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conexion, $query);

        // Verificar si el usuario ya existe
        if (mysqli_num_rows($result) > 0) {
            // Usuario ya existe
            $error = "El usuario ya está registrado.";
        } else {
            // Insertar el nuevo usuario en la base de datos
            $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            if (mysqli_query($conexion, $query)) {
                // Registro exitoso
                $_SESSION['username'] = $username;
                header("Location: ../login.html");
                exit;
            } else {
                // Error al insertar el usuario
                $error = "Error al registrar el usuario: " . mysqli_error($conexion);
            }
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
            }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <form action="registro.php" method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="Registrarse">
        </form>
    </div>
</body>
</html>
