<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_app('includes/isSessionStarted.php');
?>
<!doctype html>
<html lang="en">

<?php
    require_app('templates/header.php')
?>

<div class="contenido">
  <?php if (!empty($_GET['error'])): ?>
    <div class="alert alert-danger" role="alert"><?php echo app_h($_GET['error']); ?></div>
  <?php endif; ?>
  <?php $esAdmin = !empty($_SESSION['esAdmin']); ?>
  <?php if (!$esAdmin): ?>
    <div class="alert alert-info">La solicitud queda pendiente hasta que un administrador la apruebe. No vas a poder ingresar antes.</div>
  <?php endif; ?>
  <form action= "./acciones/registrarDocente.php" method="post" class="formulario">
      
      <div class="titulo">
          <h2><?php echo $esAdmin ? 'Alta de docente' : 'Solicitud de alta docente'; ?></h2>
      </div>

      <div class="form-group">
          <label for="exampleInputNombre">Nombre</label>
          <input name="nombreDocente" type="text" class="form-control" id="nombreDocente" aria-describedby="emailHelp" placeholder="Ingrese su nombre" required>
        </div>
        <div class="form-group">
          <label for="exampleInputApellido">Apellido</label>
          <input name="apellidoDocente" type="text" class="form-control" id="apellidoDocente" aria-describedby="emailHelp" placeholder="Ingrese su apellido" required>
        </div>
        <div class="form-group">
          <label for="idMateria">Cátedra</label>
          <select name="idMateria" id="idMateria" class="form-select" required>
            <option value="" disabled selected>Seleccioná la cátedra</option>
            <?php
              require app_path('config/db.php');
              $materias = mysqli_query($conexion, 'SELECT id, nombre_materia FROM materias ORDER BY nombre_materia') or app_die($conexion);
              while ($materia = $materias->fetch_assoc()) {
                  echo '<option value="' . (int) $materia['id'] . '">' . app_h($materia['nombre_materia']) . '</option>';
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Legajo</label>
          <input name="legajoDocente" type="text" class="form-control" title="Ingrese solo números" pattern="[0-9]*" id="legajoDocente" maxlength="6" aria-describedby="emailHelp" placeholder="Ingrese su legajo" required>
        </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input name="emailDocente" type="email" class="form-control" id="emailDocente" aria-describedby="emailHelp" placeholder="Ingrese su email" required>
      </div>
      <div class="form-group">
        <label for="contraseñaDocente">Contraseña</label>
        <div class="clave-campo">
          <input name="contraseñaDocente" type="password" class="form-control" id="contraseñaDocente" minlength="8" placeholder="Mínimo 8 caracteres, con letras y números" required>
          <?php require app_path('includes/botonVerClave.php'); ?>
        </div>
      </div>
      <button type="submit" class="btn btn-primary margined"><?php echo $esAdmin ? 'Dar de alta' : 'Enviar solicitud'; ?></button>
    </form>
</div>
<?php
    require_app('templates/footer.php')
?>

</html>
