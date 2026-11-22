<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_app('includes/restringidoAdmin.php');

$legajo = (int) ($_GET['legajo'] ?? 0);
require app_path('config/db.php');

$stmt = $conexion->prepare('UPDATE profesores SET activo = 1 WHERE legajo = ?');
$stmt->bind_param('i', $legajo);
$stmt->execute() or app_die($conexion);
mysqli_close($conexion);

header('Location: ../panelAdminDocentes.php?msg=' . urlencode('El docente fue aprobado.'));
exit();
