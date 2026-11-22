<?php
require_once __DIR__ . '/../includes/bootstrap.php';
$id = $_GET['id'];

require app_path('config/db.php');

$consulta="UPDATE consultas SET estado = 1 WHERE id = $id;";
$resultado = mysqli_query($conexion,$consulta) or app_die($conexion);

if(is_object($resultado))
    mysqli_free_result($resultado);

mysqli_close($conexion);

header("Location: ../misConsultasDoc.php?msg=".urlencode("La consulta fue desbloqueada correctamente"));
exit();

?>
