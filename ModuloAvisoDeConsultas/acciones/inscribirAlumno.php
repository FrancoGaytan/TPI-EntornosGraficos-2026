<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_app('includes/isSessionStarted.php');

$idConsulta=$_GET['id'];
$legajo=$_SESSION['legajo'];

require app_path('config/db.php');

mysqli_init();
$consulta="INSERT INTO alumno_consulta (legajo_alumno, id_consulta) VALUES ('$legajo', '$idConsulta')";
$resultado=mysqli_query($conexion,$consulta);

if (mysqli_errno($conexion) == 1062) {
    mysqli_close($conexion);
    header('Location: ../listadoConsultas.php?tipo=danger&msg=' . urlencode('Ya estas registrado a esta consulta.'));
    exit();
}

$consulta2="UPDATE consultas SET cupo = cupo - 1 WHERE id = $idConsulta and cupo > 0;";
$resultado2=mysqli_query($conexion,$consulta2) or app_die($conexion);

mysqli_close($conexion);

header('Location: ../listadoConsultas.php?tipo=success&msg=' . urlencode('La inscripción fue registrada correctamente.'));
exit();

?>
