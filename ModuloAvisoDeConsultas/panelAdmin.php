<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_app('includes/restringidoAdmin.php');
require app_path('config/db.php');

function admin_contar($conexion, $sql) {
    $resultado = mysqli_query($conexion, $sql) or app_die($conexion);
    $fila = mysqli_fetch_assoc($resultado);
    return (int) $fila['n'];
}

$pendientes = admin_contar($conexion, 'SELECT COUNT(*) AS n FROM profesores WHERE activo = 0');
$alumnos = admin_contar($conexion, 'SELECT COUNT(*) AS n FROM alumnos');
$activas = admin_contar($conexion, 'SELECT COUNT(*) AS n FROM consultas WHERE estado = 1 AND fecha_hora >= NOW()');
$hoy = admin_contar(
    $conexion,
    'SELECT COUNT(*) AS n
     FROM alumno_consulta ac
     INNER JOIN consultas c ON c.id = ac.id_consulta
     WHERE ac.cancelada = 0 AND DATE(c.fecha_hora) = CURDATE()'
);
?>
<!doctype html>
<html lang="es">

<?php require_app('templates/header.php') ?>

<div class="container acerca">
    <h2>Panel de administración</h2>
    <p>Hola, <?php echo app_h($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?>.</p>

    <div class="admin-resumen">
        <article class="consulta-card">
            <p class="admin-numero"><?php echo $pendientes; ?></p>
            <p>Docentes pendientes</p>
        </article>
        <article class="consulta-card">
            <p class="admin-numero"><?php echo $alumnos; ?></p>
            <p>Alumnos</p>
        </article>
        <article class="consulta-card">
            <p class="admin-numero"><?php echo $activas; ?></p>
            <p>Consultas activas</p>
        </article>
        <article class="consulta-card">
            <p class="admin-numero"><?php echo $hoy; ?></p>
            <p>Inscriptos en consultas de hoy</p>
        </article>
    </div>

    <div class="admin-acciones">
        <a class="btn btn-primary" href="panelAdminDocentes.php">Docentes</a>
        <a class="btn btn-primary" href="panelAdminAlumnos.php">Alumnos</a>
        <a class="btn btn-outline-secondary" href="panelAdminDocentes.php?pendientes=1">Solicitudes por aprobar</a>
    </div>
</div>

<?php require_app('templates/footer.php') ?>

</html>
