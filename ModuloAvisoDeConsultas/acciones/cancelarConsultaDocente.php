<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/notificar.php';
require_app('includes/restringidoDocente.php');

$id = (int) ($_POST['id'] ?? 0);
$motivo = trim($_POST['motivo'] ?? '');
$legajo = (int) $_SESSION['legajo'];

if (strlen($motivo) < 5) {
    header('Location: ../misConsultasDoc.php?msg=' . urlencode('Indicá un motivo de al menos 5 caracteres para cancelar.'));
    exit();
}

require app_path('config/db.php');
$motivoSql = $conexion->real_escape_string($motivo);
mysqli_query($conexion, "UPDATE consultas SET estado = 2, motivo = '{$motivoSql}' WHERE id = {$id} AND id_profesor = {$legajo} AND estado <> 2") or app_die($conexion);

if ($conexion->affected_rows > 0) {
    app_notificar_inscriptos($conexion, $id, 'Consulta cancelada', "La consulta fue cancelada. Motivo: {$motivo}");
    $aviso = 'La consulta fue cancelada.' . app_aviso_mail();
} else {
    $aviso = 'No se pudo cancelar la consulta.';
}
mysqli_close($conexion);
header('Location: ../misConsultasDoc.php?msg=' . urlencode($aviso));
exit();
