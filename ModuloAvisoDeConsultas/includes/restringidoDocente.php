<?php
require_once __DIR__ . '/bootstrap.php';
require_app('includes/isSessionStarted.php');

if (empty($_SESSION['esDocente'])) {
    $aviso = urlencode('Para entrar a esta página iniciá sesión como docente.');
    header('Location: ' . app_url('loginDocente.php') . '?aviso=' . $aviso);
    exit();
}
