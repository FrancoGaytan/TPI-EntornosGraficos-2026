<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/notificar.php';
require_app('includes/restringidoDocente.php');

$id = (int) ($_POST['id'] ?? 0);
$fecha = $_POST['fechaConsulta'] ?? '';
$hora = $_POST['horaConsulta'] ?? '';
$legajo = (int) $_SESSION['legajo'];

$fechaHora = DateTime::createFromFormat('Y-m-d H:i', $fecha . ' ' . $hora);
$mensaje = app_fecha_consulta_mensaje($fechaHora);
if ($mensaje) {
    header('Location: ../misConsultasDoc.php?msg=' . urlencode($mensaje));
    exit();
}

$fechaString = $fechaHora->format('Y-m-d H:i:s');
require app_path('config/db.php');

mysqli_query($conexion, "UPDATE consultas SET fecha_hora = '{$fechaString}' WHERE id = {$id} AND id_profesor = {$legajo} AND estado = 1") or app_die($conexion);

if ($conexion->affected_rows > 0) {
    app_notificar_inscriptos($conexion, $id, 'Consulta reprogramada', 'La consulta cambió de fecha y hora.');
    $aviso = 'La consulta fue reprogramada.' . app_aviso_mail();
} else {
    $aviso = 'No se pudo reprogramar la consulta.';
}
mysqli_close($conexion);
header('Location: ../misConsultasDoc.php?msg=' . urlencode($aviso));
exit();
