<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_app('includes/isSessionStarted.php');

$legajo = (int) ($_SESSION['login_legajo_pendiente'] ?? 0);
$codigo = trim($_POST['codigo'] ?? '');

if ($legajo === 0 || $codigo === '') {
    header('Location: ../loginAlumno.php?error=' . urlencode('Volvé a pedir el código de ingreso.'));
    exit();
}

require app_path('config/db.php');

$stmt = $conexion->prepare('SELECT id, codigo_hash FROM codigos_acceso WHERE legajo_alumno = ? AND usado = 0 AND expira >= NOW() ORDER BY id DESC LIMIT 1');
$stmt->bind_param('i', $legajo);
$stmt->execute() or app_die($conexion);
$filaCodigo = $stmt->get_result()->fetch_assoc();

if (!$filaCodigo || !password_verify($codigo, $filaCodigo['codigo_hash'])) {
    header('Location: ../loginAlumnoCodigo.php?error=' . urlencode('El código no es válido o ya venció.'));
    exit();
}

$idCodigo = (int) $filaCodigo['id'];
mysqli_query($conexion, "UPDATE codigos_acceso SET usado = 1 WHERE id = {$idCodigo}") or app_die($conexion);

$alu = $conexion->prepare('SELECT legajo, nombre, apellido, email FROM alumnos WHERE legajo = ?');
$alu->bind_param('i', $legajo);
$alu->execute() or app_die($conexion);
$fila = $alu->get_result()->fetch_assoc();

$_SESSION['email'] = $fila['email'];
$_SESSION['legajo'] = $fila['legajo'];
$_SESSION['nombre'] = $fila['nombre'];
$_SESSION['apellido'] = $fila['apellido'];
$_SESSION['esAlumno'] = true;
$_SESSION['esDocente'] = false;
$_SESSION['esAdmin'] = false;
unset($_SESSION['login_legajo_pendiente'], $_SESSION['login_email_pendiente'], $_SESSION['codigo_demo']);

mysqli_close($conexion);
header('Location: ../listadoConsultas.php');
exit();
