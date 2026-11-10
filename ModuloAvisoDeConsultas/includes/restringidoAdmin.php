<?php
require_once __DIR__ . '/bootstrap.php';
require_app('includes/isSessionStarted.php');

//var_dump($_SESSION);

if ((!isset($_SESSION['esAdmin'])) or (!$_SESSION['esAdmin'])){ 
    echo '<div class="alert alert-danger" role="alert">
    Solo los Administradores tienen acceso a esta página
    </div>';
    require __DIR__ . '/../index.php';
    die();
}

?>
