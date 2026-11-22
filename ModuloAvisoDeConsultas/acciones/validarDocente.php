<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_app('includes/isSessionStarted.php');
$email = trim($_POST['email'] ?? '');
$contraseña = $_POST['contrasenia'] ?? '';

$_SESSION = array();

require app_path('config/db.php');

$stmt = $conexion->prepare('SELECT * FROM profesores WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute() or app_die($conexion);
$fila = $stmt->get_result()->fetch_assoc();

$claveOk = $fila && app_clave_coincide($contraseña, $fila['contrasenia']);

if ($claveOk && (int) $fila['activo'] !== 1) {
    header('Location: ../loginDocente.php?error=' . urlencode('Tu alta todavía no fue aprobada por el administrador.'));
    exit();
}

if ($claveOk) {
    if (!app_clave_es_hash($fila['contrasenia'])) {
        $hash = password_hash($contraseña, PASSWORD_DEFAULT);
        $up = $conexion->prepare('UPDATE profesores SET contrasenia = ? WHERE legajo = ?');
        $legajo = (int) $fila['legajo'];
        $up->bind_param('si', $hash, $legajo);
        $up->execute();
    }
    $_SESSION['email'] = $email;
    $_SESSION['legajo'] = $fila['legajo'];
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['apellido'] = $fila['apellido'];
    $_SESSION['esDocente'] = true;
    $_SESSION['esAlumno'] = false;
    $_SESSION['esAdmin'] = false;
    mysqli_close($conexion);
    header('Location: ../misConsultasDoc.php');
    exit();
}

mysqli_close($conexion);
header('Location: ../loginDocente.php?error=' . urlencode('Error en la autenticación'));
exit();
