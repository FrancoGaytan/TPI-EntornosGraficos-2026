<?php
require_once __DIR__ . '/includes/bootstrap.php';
?>
<!doctype html>
<html lang="en">

<?php
    require_app('templates/header.php')
?>

<div class="contenido margined">
  <div class="aviso-login">
    <?php if (!empty($_GET['error'])): ?>
      <div class="alert alert-danger aviso-temporal" role="alert"><?php echo htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
  </div>
  <form action="./acciones/validarAdmin.php" method="post" class="formulario">
      <div class="titulo">
          <h2>Inicio de sesión</h2>
      </div>
      
      <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Ingrese su email">
      </div>

      <div class="form-group">
        <label for="inputContrasenia">Contraseña</label>
        <div class="clave-campo">
          <input type="password" name="contrasenia" class="form-control" id="inputContrasenia" placeholder="Ingrese su contraseña">
          <?php require app_path('includes/botonVerClave.php'); ?>
        </div>
      </div>

      <button type="submit" class="btn btn-primary margined">Ingresar</button>
    </form>
</div>

<?php
    require_app('templates/footer.php')
?>

</html>
