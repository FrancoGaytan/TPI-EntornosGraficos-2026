<?php
require_once __DIR__ . '/../includes/bootstrap.php';
$id = $_GET['id'];
$legAlumno = $_GET['legAlumno'];

require app_path('config/db.php');

$consulta="DELETE alumno_consulta WHERE id_consulta = $id and legajo_alumno = $legAlumno;";
$resultado=mysqli_query($conexion,$consulta) or app_die($conexion);

$consulta2="UPDATE consultas SET cupo = cupo + 1 WHERE id = $id;";
$resultado2=mysqli_query($conexion,$consulta) or app_die($conexion);

echo "<div class='alert alert-success' role='alert'>
La consulta fue cancelada correctamente
</div>";
require __DIR__ . '/../perfilAlumno.php';

mysqli_free_result($resultado);
mysqli_close($conexion);

?>
