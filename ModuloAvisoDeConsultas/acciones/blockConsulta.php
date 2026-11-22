<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/notificar.php';
require_app('includes/restringidoDocente.php');

$id = (int) ($_POST['id'] ?? 0);
$motivo = trim($_POST['motivo'] ?? '');
$legajo = (int) $_SESSION['legajo'];

if (strlen($motivo) < 5) {
    header('Location: ../misConsultasDoc.php?msg=' . urlencode('Indicá un motivo de al menos 5 caracteres para bloquear.'));
    exit();
}

require app_path('config/db.php');
$motivoSql = $conexion->real_escape_string($motivo);
$resultado = mysqli_query($conexion, "UPDATE consultas SET estado = 0, motivo = '{$motivoSql}' WHERE id = {$id} AND id_profesor = {$legajo} AND estado = 1") or app_die($conexion);

if ($conexion->affected_rows > 0) {
    app_notificar_inscriptos($conexion, $id, 'Consulta bloqueada', "La consulta fue bloqueada. Motivo: {$motivo}");
    $aviso = 'La consulta fue bloqueada.' . app_aviso_mail();
} else {
    $aviso = 'No se pudo bloquear la consulta.';
}
mysqli_close($conexion);
header('Location: ../misConsultasDoc.php?msg=' . urlencode($aviso));
exit();
