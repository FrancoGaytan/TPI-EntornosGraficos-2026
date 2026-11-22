<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_app('includes/restringidoAdmin.php');
require app_path('config/db.php');

$legajo = (int) ($_GET['legajo'] ?? 0);
$stmt = $conexion->prepare('SELECT legajo, nombre, apellido, email FROM profesores WHERE legajo = ?');
$stmt->bind_param('i', $legajo);
$stmt->execute() or app_die($conexion);
$docente = $stmt->get_result()->fetch_assoc();
if (!$docente) {
    header('Location: panelAdminDocentes.php?msg=' . urlencode('No se encontró el docente.'));
    exit();
}
?>
<!doctype html>
<html lang="es">

<?php require_app('templates/header.php') ?>

<div class="contenido">
    <?php if (!empty($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert"><?php echo app_h($_GET['error']); ?></div>
    <?php endif; ?>
    <form action="./acciones/guardarDocente.php" method="post" class="formulario">
        <div class="titulo">
            <h2>Editar docente</h2>
        </div>
        <input type="hidden" name="legajo" value="<?php echo (int) $docente['legajo']; ?>">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input name="nombre" id="nombre" type="text" class="form-control" maxlength="80" required value="<?php echo app_h($docente['nombre']); ?>">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input name="apellido" id="apellido" type="text" class="form-control" maxlength="80" required value="<?php echo app_h($docente['apellido']); ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" id="email" type="email" class="form-control" maxlength="120" required value="<?php echo app_h($docente['email']); ?>">
        </div>
        <p class="text-muted">Legajo <?php echo (int) $docente['legajo']; ?></p>
        <button type="submit" class="btn btn-primary margined">Guardar</button>
        <a class="btn btn-outline-secondary" href="panelAdminDocentes.php">Volver</a>
    </form>
</div>

<?php require_app('templates/footer.php') ?>

</html>
