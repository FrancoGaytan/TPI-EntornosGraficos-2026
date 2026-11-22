<?php
require_once __DIR__ . '/bootstrap.php';
require_app('includes/isSessionStarted.php');

if (empty($_SESSION['esAlumno'])) {
    $aviso = urlencode('Para entrar a esta página iniciá sesión como alumno.');
    header('Location: ' . app_url('loginAlumno.php') . '?aviso=' . $aviso);
    exit();
}
