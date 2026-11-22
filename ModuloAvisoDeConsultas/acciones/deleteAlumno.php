<?php
require_once __DIR__ . '/../includes/bootstrap.php';
$legajo = $_GET['legajo'];

require app_path('config/db.php');

$consulta="DELETE FROM alumnos WHERE legajo = $legajo;";
$resultado = mysqli_query($conexion,$consulta) or app_die($conexion);

if(is_object($resultado))
    mysqli_free_result($resultado);

mysqli_close($conexion);

header("Location: ../panelAdminAlumnos.php?msg=".urlencode("El alumno fue eliminado correctamente"));
exit();

?>
