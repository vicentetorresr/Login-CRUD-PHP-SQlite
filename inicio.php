<?php
session_start();

// Verificar si no hay una sesión activa
if (!isset($_SESSION['username'])) {
    header("Location: php/login.php");
    exit;
}

// Cerrar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: php/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styleini.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<input type="checkbox" class="menu-toggle" id="menu-toggle">
    <label class="menu-toggle-label" for="menu-toggle">&#9660;</label>

    <nav>
        <ul>
            <li><a href="php/mostrarUsuarios.php">Mostrar usuarios</a></li>
            <li><a onclick="logout()">Cerrar sesión</a></li>
        </ul>
    </nav>

    <div class="button-container">
        <button id="boton1" class="button" onclick="mostrarImagen('dialogImagen1')">Horario Sección 1</button>
        <button id="boton2" class="button" onclick="mostrarImagen('dialogImagen2')">Horario Sección 2</button>
    </div>

    <dialog class="dialog" id="dialogImagen1">
        <img src="img/2.png" width="800px" alt="Horario seccion 1">
        <button onclick="ocultarImagen('dialogImagen1')">Cerrar</button>
    </dialog>

    <dialog class="dialog" id="dialogImagen2">
        <img src="img/1fake.png" width="800px" alt="Horario seccion 2">
        <button onclick="ocultarImagen('dialogImagen2')">Cerrar</button>
    </dialog>

    <div class="overlay"></div>

    <script src="js/img.js"></script>
</body>
</html>
