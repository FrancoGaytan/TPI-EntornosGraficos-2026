<?php
require_once __DIR__ . '/../includes/bootstrap.php';
$id = $_GET['id'];

require_app('config/db.php');

$consulta="DELETE FROM consultas WHERE id = $id;";
$resultado = mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));

if(is_object($resultado))
    mysqli_free_result($resultado);

mysqli_close($conexion);

header("Location: ../misConsultasDoc.php?msg=".urlencode("La consulta fue eliminada correctamente"));
exit();

?>
