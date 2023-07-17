<?php
session_start();

// Verificar si no hay una sesión activa
if (!isset($_SESSION['username'])) {
    header("Location: ../php/login.php");
    exit;
}


// Cerrar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../php/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Full Width Pics - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">CFT SAN AGUSTIN</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="../login.html" onclick="logout()">Cerrar</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header - set the background image for the header in the line below-->
        <header class="py-5 bg-image-full" style="background-image: url('assets/bg1.png')">
            <div class="text-center my-5">
                <img class="img-fluid rounded-circle mb-4" src="assets/emblema.png" alt="..." />
                <h1 class="text-white fs-3 fw-bolder">CFT SAN AGUSTIN</h1>
                <p class="text-white-50 mb-0">fino señores</p>
            </div>
        </header>
        <!-- Content section-->
        <section class="py-5">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2>El camino hacia la excelencia</h2>
                        <p class="lead">Acreditados consecutivamente desde 2007 y actualmente por 5 años, hoy avanzamos hacia la excelencia en un nuevo proceso de acreditación institucional.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Image element - set the background image for the header in the line below-->
        <div class="py-5 bg-image-full" style="background-image: url('assets/bg2.jpg')">
            <!-- Put anything you want here! The spacer below with inline CSS is just for demo purposes!-->
            <div style="height: 20rem"></div>
        </div>
        <!-- Content section-->
        <section class="py-5">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2>Analista Programador</h2>
                        <p class="mb-0">Diseña, desarrolla, implementa y mantén software empresarial, gestiona servicios TI, desarrolla sistemas computacionales y identifica y solucione problemas de software y hardware en empresas e instituciones públicas y privadas que necesites disponer de estos servicios, así como en empresas de desarrollo de software y sistemas computacionales, compañías asesoras o comercializadoras de hardware y software, bancos, entidades financieras, comercio, servicios públicos o ejerce libremente tu profesión como asesor externo o en emprendimientos propios.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 5k por verlo cuenta rut</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>


