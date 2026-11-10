<?php
require_once __DIR__ . '/../includes/bootstrap.php';
$nombreDocente=$_POST['nombreDocente'];
$apellidoDocente=$_POST['apellidoDocente'];
$legajoDocente=(int) $_POST['legajoDocente'];
$emailDocente=$_POST['emailDocente'];
$contraseñaDocente=$_POST['contraseñaDocente'];

require_app('config/db.php');

// Busco por legajo
$consulta = "SELECT Count(legajo) as cantidad FROM profesores WHERE legajo='$legajoDocente'";
$resultado = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
$cantProfesoresLegajo = mysqli_fetch_assoc($resultado);

// Busco por email
$consulta = "SELECT Count(legajo) as cantidad FROM profesores WHERE email='$emailDocente'";
$resultado = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
$cantProfesoresEmail = mysqli_fetch_assoc($resultado);

if ($cantProfesoresLegajo ['cantidad']!=0){
      echo '<div class="alert alert-danger" role="alert">
      Ya existe un docente con ese legajo
      </div>';
      require __DIR__ . '/../regDocente.php';
}
else {
      if ($cantProfesoresEmail ['cantidad']!=0) {
            echo '<div class="alert alert-danger" role="alert">
            Ya existe un docente con ese email
            </div>';
            require __DIR__ . '/../regDocente.php';
      }
      else {
            $consulta = "INSERT INTO profesores (legajo, nombre, apellido, email, contrasenia) 
                  VALUES ('$legajoDocente', '$nombreDocente', '$apellidoDocente', '$emailDocente', '$contraseñaDocente')";
            $resultado=mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
            echo "<div class='alert alert-success' role='alert'>
            El profesor $nombreDocente $apellidoDocente fue agregado correctamente
            </div>";
            require __DIR__ . '/../loginDocente.php';
      }
}

// Liberar conjunto de resultados
mysqli_free_result($resultado);
mysqli_close($conexion);

?>
