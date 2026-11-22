<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_app('includes/isSessionStarted.php');

$nombre = trim($_POST['nombreDocente'] ?? '');
$apellido = trim($_POST['apellidoDocente'] ?? '');
$legajo = (int) ($_POST['legajoDocente'] ?? 0);
$email = trim($_POST['emailDocente'] ?? '');
$clave = $_POST['contraseñaDocente'] ?? '';
$idMateria = (int) ($_POST['idMateria'] ?? 0);

$volver = '../regDocente.php?error=';

if ($nombre === '' || $apellido === '' || $legajo <= 0 || $email === '' || $idMateria <= 0) {
    header('Location: ' . $volver . urlencode('Completá todos los datos.'));
    exit();
}

$mensajeClave = app_clave_mensaje($clave);
if ($mensajeClave) {
    header('Location: ' . $volver . urlencode($mensajeClave));
    exit();
}

require app_path('config/db.php');

$porLegajo = $conexion->prepare('SELECT legajo FROM profesores WHERE legajo = ?');
$porLegajo->bind_param('i', $legajo);
$porLegajo->execute() or app_die($conexion);
if ($porLegajo->get_result()->fetch_assoc()) {
    header('Location: ' . $volver . urlencode('Ya existe un docente con ese legajo.'));
    exit();
}

$porEmail = $conexion->prepare('SELECT legajo FROM profesores WHERE email = ?');
$porEmail->bind_param('s', $email);
$porEmail->execute() or app_die($conexion);
if ($porEmail->get_result()->fetch_assoc()) {
    header('Location: ' . $volver . urlencode('Ya existe un docente con ese email.'));
    exit();
}

$materia = $conexion->prepare('SELECT id FROM materias WHERE id = ?');
$materia->bind_param('i', $idMateria);
$materia->execute() or app_die($conexion);
if (!$materia->get_result()->fetch_assoc()) {
    header('Location: ' . $volver . urlencode('Esa cátedra no existe.'));
    exit();
}

$esAdmin = !empty($_SESSION['esAdmin']);
$activo = $esAdmin ? 1 : 0;
$hash = password_hash($clave, PASSWORD_DEFAULT);

$conexion->begin_transaction();
$ins = $conexion->prepare('INSERT INTO profesores (legajo, nombre, apellido, email, contrasenia, activo) VALUES (?, ?, ?, ?, ?, ?)');
$ins->bind_param('issssi', $legajo, $nombre, $apellido, $email, $hash, $activo);
if (!$ins->execute()) {
    $conexion->rollback();
    app_die($conexion);
}
$asig = $conexion->prepare('INSERT INTO profesor_materia (legajo_profesor, id_materia) VALUES (?, ?)');
$asig->bind_param('ii', $legajo, $idMateria);
if (!$asig->execute()) {
    $conexion->rollback();
    app_die($conexion);
}
$conexion->commit();
mysqli_close($conexion);

if ($esAdmin) {
    header('Location: ../panelAdminDocentes.php?msg=' . urlencode("El docente $nombre $apellido fue dado de alta."));
    exit();
}

header('Location: ../loginDocente.php?error=' . urlencode('Solicitud enviada. Vas a poder ingresar cuando el administrador la apruebe.'));
exit();
