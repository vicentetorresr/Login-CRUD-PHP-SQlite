<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar los campos
    if (empty($username) || empty($password)) {
        $error = "Por favor, complete todos los campos.";
    } else {
        // Conexión a la base de datos SQLite
        $db = new SQLite3('../db/user.db');

        // Escapar los valores para evitar ataques de inyección SQL (NO necesario para SQLite)
        // $username = SQLite3::escapeString($username);
        // $password = SQLite3::escapeString($password);

        // Consultar la base de datos para verificar si el usuario ya existe
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $db->query($query);

        // Verificar si el usuario ya existe
        if ($result && $result->fetchArray()) {
            // Usuario ya existe
            $error = "El usuario ya está registrado.";
        } else {
            // Insertar el nuevo usuario en la base de datos
            $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            if ($db->exec($query)) {
                // Registro exitoso
                $_SESSION['username'] = $username;
                header("Location: ../login.html");
                exit;
            } else {
                // Error al insertar el usuario
                $error = "Error al registrar el usuario: " . $db->lastErrorMsg();
            }
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
