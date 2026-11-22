<?php
require_once __DIR__ . '/../includes/bootstrap.php';
$id = $_POST['id'];
$legAlumno = $_POST['legAlumno'];

require app_path('config/db.php');

$consulta="DELETE FROM alumno_consulta WHERE id_consulta={$id} and legajo_alumno={$legAlumno};";
$resultado=mysqli_query($conexion,$consulta) or app_die($conexion);

$consulta2="UPDATE consultas SET cupo = cupo + 1 WHERE id = {$id};";
$resultado2=mysqli_query($conexion,$consulta2) or app_die($conexion);

if(is_object($resultado))
    mysqli_free_result($resultado);
mysqli_close($conexion);

header("Location: ../listadoConsultas.php?msg=".urlencode("La inscripción a consulta fue eliminada correctamente"));
exit();

?>
