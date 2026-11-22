<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_app('includes/isSessionStarted.php');

if (empty($_SESSION['login_legajo_pendiente'])) {
    header('Location: loginAlumno.php');
    exit();
}
?>
<!doctype html>
<html lang="es">

<?php require_app('templates/header.php') ?>

<div class="contenido margined">
  <?php if (!empty($_GET['error'])): ?>
    <div class="alert alert-danger" role="alert"><?php echo app_h($_GET['error']); ?></div>
  <?php endif; ?>
  <div class="alert alert-info" role="alert">
    Enviamos un código a <?php echo app_h($_SESSION['login_email_pendiente'] ?? 'tu correo'); ?>. Revisá la bandeja de entrada.
  </div>
  <form action="./acciones/validarCodigoAlumno.php" method="post" class="formulario">
    <div class="titulo"><h2>Código de ingreso</h2></div>
    <div class="form-group">
      <label for="codigo">Código</label>
      <input type="text" name="codigo" id="codigo" class="form-control" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" required placeholder="6 dígitos">
    </div>
    <button type="submit" class="btn btn-primary margined">Ingresar</button>
  </form>
</div>

<?php require_app('templates/footer.php') ?>
</html>
