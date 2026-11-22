<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/mail.php';
require_app('includes/destroySession.php');
require_app('includes/isSessionStarted.php');

$email = trim($_POST['email'] ?? '');
$legajo = (int) ($_POST['legajo'] ?? 0);

require app_path('config/db.php');

$stmt = $conexion->prepare('SELECT legajo, nombre, apellido, email FROM alumnos WHERE email = ? AND legajo = ?');
$stmt->bind_param('si', $email, $legajo);
$stmt->execute() or app_die($conexion);
$fila = $stmt->get_result()->fetch_assoc();

if (!$fila) {
    header('Location: ../loginAlumno.php?error=' . urlencode('El legajo y el correo no coinciden con un alumno registrado.'));
    exit();
}

$codigo = (string) random_int(100000, 999999);
$hash = password_hash($codigo, PASSWORD_DEFAULT);
$legajoAlumno = (int) $fila['legajo'];

mysqli_query($conexion, "UPDATE codigos_acceso SET usado = 1 WHERE legajo_alumno = {$legajoAlumno} AND usado = 0") or app_die($conexion);

$ins = $conexion->prepare('INSERT INTO codigos_acceso (legajo_alumno, codigo_hash, expira) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 10 MINUTE))');
$ins->bind_param('is', $legajoAlumno, $hash);
$ins->execute() or app_die($conexion);

$cuerpo = "Hola {$fila['nombre']},\n\nTu código para ingresar a Consultas UTN es {$codigo}.\nVence en 10 minutos.\n";
$enviado = app_enviar_mail($fila['email'], 'Código de ingreso — Consultas UTN', $cuerpo);

$_SESSION['login_legajo_pendiente'] = $legajoAlumno;
$_SESSION['login_email_pendiente'] = $fila['email'];

mysqli_close($conexion);

if (!$enviado) {
    header('Location: ../loginAlumno.php?error=' . urlencode('No se pudo enviar el código. Revisá la configuración de correo.'));
    exit();
}

header('Location: ../loginAlumnoCodigo.php');
exit();
