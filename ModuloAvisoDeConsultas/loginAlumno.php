<?php
require_once __DIR__ . '/includes/bootstrap.php';
?>
<!doctype html>
<html lang="es">

<?php
    require_app('templates/header.php')
?>

<div class="contenido margined">
  <div class="aviso-login">
    <?php if (!empty($_GET['error'])): ?>
      <div class="alert alert-danger aviso-temporal" role="alert"><?php echo htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'); ?></div>
    <?php elseif (!empty($_GET['aviso'])): ?>
      <div class="alert alert-info aviso-temporal" role="alert"><?php echo htmlspecialchars($_GET['aviso'], ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
  </div>
  <form action="./acciones/validarAlumno.php" method="post" class="formulario">
      <div class="titulo">
          <h2>Ingreso alumno</h2>
      </div>
  
      <div class="form-group">
        <label for="inputLegajo">Legajo</label>
        <input type="text" name="legajo" class="form-control" id="inputLegajo" inputmode="numeric" pattern="[0-9]*" maxlength="6" required placeholder="Ingrese su legajo">
      </div>

      <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="email" name="email" class="form-control" id="inputEmail" required placeholder="Ingrese su email">
      </div>
      <p class="text-muted">Te vamos a enviar un código a ese correo para confirmar que sos vos.</p>
  
      <button type="submit" class="btn btn-primary margined">Ingresar</button>
    </form>
</div>
  
<?php
    require_app('templates/footer.php')
?>

</html>
