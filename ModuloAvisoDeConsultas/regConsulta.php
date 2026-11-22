<?php
require_once __DIR__ . '/includes/bootstrap.php';
    require_app('includes/isSessionStarted.php');
    require_app('includes/restringidoDocente.php')
?>

<!doctype html>
<html lang="en">

<?php
    require_app('templates/header.php')
?>

<?php if (!empty($_GET['msg'])): ?>
    <div class="alert alert-success margined" role="alert"><?php echo app_h($_GET['msg']); ?></div>
<?php endif; ?>
<?php if (!empty($_GET['error'])): ?>
    <div class="alert alert-danger margined" role="alert"><?php echo app_h($_GET['error']); ?></div>
<?php endif; ?>

<div class="contenido">
    
  <form action="./acciones/registrarConsulta.php" method="post" class="formulario form-group">
      <?php
      if ((isset($_SESSION['esAdmin'])) && ($_SESSION['esAdmin'])) {
        echo '<div class="alert alert-warning" role="alert">
        Estás como administrador. Para publicar una consulta, entrá con un usuario docente.
        </div>';
      }
      ?>

      <div class="titulo">
          <h2>Registro de Nueva Consulta</h2>
      </div>

      <select name="idMateria" class="form-select" aria-label="Default select example" required>
        <option disabled selected>Selecciona la materia</option>
        <?php
          require_app('includes/getMateriasDocente.php')
        ?>
      </select>

      <div class="form-group">
        <label for="fechaConsulta">Dia de Consulta</label>
        <input name="fechaConsulta" type="date" class="form-control" id="diaConsulta" aria-describedby="emailHelp" placeholder="Ingrese el día de consulta" required>
      </div>

      <div class="form-group">
        <label for="horaConsulta">Horario de Consulta</label>
        <input name="horaConsulta" type="time" class="form-control" step="300" id="horaConsulta" aria-describedby="emailHelp" placeholder="Ingrese el horario de consulta" required>
      </div>

      <div class="form-group">
        <label for="cupoConsulta">Cupo maximo de consulta</label>
        <input name="cupoConsulta" type="number" class="form-control" id="cupoConsulta" aria-describedby="emailHelp" placeholder="Ingrese el cupo de la consulta" required>
      </div>

      <button type="submit" class="btn btn-primary margined">Confirmar</button>
    </form>
</div>

<?php
    require_app('templates/footer.php')
?>

</html>

</html>
