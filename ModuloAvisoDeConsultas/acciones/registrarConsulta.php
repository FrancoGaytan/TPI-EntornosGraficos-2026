<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_app('includes/restringidoDocente.php');

$idMateria = (int) ($_POST['idMateria'] ?? 0);
$fechaConsulta = $_POST['fechaConsulta'] ?? '';
$horaConsulta = $_POST['horaConsulta'] ?? '';
$cupo = (int) ($_POST['cupoConsulta'] ?? 0);
$legajo = (int) $_SESSION['legajo'];

$fechaHora = DateTime::createFromFormat('Y-m-d H:i', $fechaConsulta . ' ' . $horaConsulta);
$mensaje = app_fecha_consulta_mensaje($fechaHora);
if ($mensaje) {
    header('Location: ../regConsulta.php?error=' . urlencode($mensaje));
    exit();
}
if ($cupo < 1 || $cupo > 40) {
    header('Location: ../regConsulta.php?error=' . urlencode('El cupo debe estar entre 1 y 40.'));
    exit();
}

require app_path('config/db.php');
$propia = mysqli_query($conexion, "SELECT 1 FROM profesor_materia WHERE legajo_profesor = {$legajo} AND id_materia = {$idMateria}") or app_die($conexion);
if ($propia->num_rows === 0) {
    header('Location: ../regConsulta.php?error=' . urlencode('Solo podés registrar consultas de tus cátedras.'));
    exit();
}

$fechaString = $fechaHora->format('Y-m-d H:i:s');
mysqli_query($conexion, "INSERT INTO consultas (fecha_hora, cupo, id_profesor, id_materia) VALUES ('{$fechaString}', {$cupo}, {$legajo}, {$idMateria})") or app_die($conexion);
mysqli_close($conexion);

header('Location: ../misConsultasDoc.php?msg=' . urlencode('La consulta fue agregada correctamente.'));
exit();
