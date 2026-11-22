<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_app('includes/isSessionStarted.php');

if (empty($_SESSION['esAdmin'])) {
    header('Location: ../loginAdmin.php');
    exit();
}

$legajo = (int) ($_POST['legajo'] ?? 0);
$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$email = trim($_POST['email'] ?? '');
$volver = '../editarAlumno.php?legajo=' . $legajo . '&error=';

if ($legajo <= 0 || $nombre === '' || $apellido === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ' . $volver . urlencode('Completá nombre, apellido y un email válido.'));
    exit();
}
if (strlen($nombre) > 80 || strlen($apellido) > 80 || strlen($email) > 120) {
    header('Location: ' . $volver . urlencode('Alguno de los datos es demasiado largo.'));
    exit();
}

require app_path('config/db.php');

$existe = $conexion->prepare('SELECT legajo FROM alumnos WHERE email = ? AND legajo <> ?');
$existe->bind_param('si', $email, $legajo);
$existe->execute() or app_die($conexion);
if ($existe->get_result()->fetch_assoc()) {
    header('Location: ' . $volver . urlencode('Ya hay un alumno con ese email.'));
    exit();
}

$up = $conexion->prepare('UPDATE alumnos SET nombre = ?, apellido = ?, email = ? WHERE legajo = ?');
$up->bind_param('sssi', $nombre, $apellido, $email, $legajo);
$up->execute() or app_die($conexion);

header('Location: ../panelAdminAlumnos.php?msg=' . urlencode('El alumno fue actualizado.'));
exit();
