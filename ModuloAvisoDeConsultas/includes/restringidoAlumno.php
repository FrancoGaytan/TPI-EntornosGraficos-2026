<?php
require_once __DIR__ . '/bootstrap.php';
require_app('includes/isSessionStarted.php');

if ((!isset($_SESSION['esAlumno'])) or (!$_SESSION['esAlumno'])){ 
    echo '<div class="alert alert-danger" role="alert">
    Solo los Alumnos tienen acceso a esta página
    </div>';
    require __DIR__ . '/../index.php';
    die();
}

?>
