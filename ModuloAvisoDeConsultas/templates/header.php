<?php
require_once __DIR__ . '/../includes/bootstrap.php';
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/favicon.png?v=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/estilos.css?v=17" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <title>Consultas UTN</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="./base.php">
                <img alt="Logo UTN" src="img/logo2.png" width="120" height="90">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <?php
                        if((isset($_SESSION['esAlumno'])) and ($_SESSION['esAlumno'])) {
                            echo '
                            <li class="nav-item">
                            <a class="nav-link" href="./listadoConsultas.php" id="Horarios">Horarios</a>
                            </li>
                            ';
                        }
                        if((isset($_SESSION['esDocente'])) and ($_SESSION['esDocente'])){
                            echo '
                            <li class="nav-item">
                            <a class="nav-link" href="./regConsulta.php" id="registroConsultas">Registro Consultas</a>
                            </li>
                            ';
                        }
                        if((isset($_SESSION['esAdmin'])) and ($_SESSION['esAdmin'])){
                            echo '
                            <li class="nav-item">
                            <a class="nav-link" href="./panelAdmin.php" id="panelAdmin">Inicio</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="./panelAdminDocentes.php" id="panelAdminDocentes">Docentes</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="./panelAdminAlumnos.php" id="panelAdminAlumnos">Alumnos</a>
                            </li>
                            ';
                        }
                    ?>
                </ul>
                    <ul class="navbar-nav ms-auto">
                        <?php
                        if(isset($_SESSION['legajo'])) {
                            echo '
                            <li class="nav-item">
                            <a class="nav-link" href="./acciones/cerrarSesion.php" id="Ingreso">Cerrar sesión</a>
                            </li>
                            ';
                        } else {
                            echo '
                            <li class="nav-item">
                            <a class="nav-link" href="./loginAlumno.php" id="Ingreso">Ingreso</a>
                            </li>
                            ';
                        }
                        if (!empty($_SESSION['esAdmin'])) {
                            echo '
                            <li class="nav-item">
                            <a class="nav-link" href="./regDocente.php">Alta docente</a>
                            </li>
                            ';
                        }
                        ?>
                    </ul>
            </div>
        </div>
    </nav>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>