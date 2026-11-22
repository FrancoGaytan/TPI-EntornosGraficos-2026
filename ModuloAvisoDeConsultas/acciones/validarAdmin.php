<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_app('includes/isSessionStarted.php');
$email=$_POST['email'];
$contraseña=$_POST['contrasenia'];

//include_once('destroySession.php');
$_SESSION = array();

require app_path('config/db.php');

$stmt = $conexion->prepare('SELECT * FROM administradores WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute() or app_die($conexion);
$fila = $stmt->get_result()->fetch_assoc();

if ($fila && app_clave_coincide($contraseña, $fila['contrasenia'])) {
    if (!app_clave_es_hash($fila['contrasenia'])) {
        $hash = password_hash($contraseña, PASSWORD_DEFAULT);
        $up = $conexion->prepare('UPDATE administradores SET contrasenia = ? WHERE legajo = ?');
        $legajo = (int) $fila['legajo'];
        $up->bind_param('si', $hash, $legajo);
        $up->execute();
    }
    $_SESSION['email']=$email;
    $_SESSION['legajo']=$fila['legajo'];
    $_SESSION['nombre']=$fila['nombre'];
    $_SESSION['apellido']=$fila['apellido'];
    $_SESSION['esDocente']=true;
    $_SESSION['esAlumno']=true;
    $_SESSION['esAdmin']=true;
    
    header("location:../panelAdmin.php");
    exit();
}

mysqli_close($conexion);
header('Location: ../loginAdmin.php?error=' . urlencode('Error en la autenticación'));
exit();

?>
