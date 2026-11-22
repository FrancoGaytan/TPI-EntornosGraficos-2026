<?php
require_once __DIR__ . '/includes/bootstrap.php';
    require_app('includes/restringidoDocente.php')
?>

<!doctype html>
<html lang="en">

<?php
    require_app('templates/header.php')
?>

<div class="contenido">
  <form action="./acciones/reprogramar.php" method="post" class="formulario">
      <div class="titulo">
          <h2>Ingrese la nueva fecha para la consulta</h2>
      </div>

      <div class="form-group">
        <label for="fechaConsulta">Dia de Consulta</label>
        <input name="fechaConsulta" type="date" class="form-control" id="diaConsulta" aria-describedby="emailHelp" placeholder="Ingrese el día de consulta" required>
      </div>

      <div class="form-group">
        <label for="horaConsulta">Horario de Consulta</label>
        <input name="horaConsulta" type="time" class="form-control" id="horaConsulta" aria-describedby="emailHelp" placeholder="Ingrese el horario de consulta" required>
      </div>

      <input type='hidden' name='id' value='<?php echo $_POST['id'] ?>'/><br>

      <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
</div>

?>

<?php
    require_app('templates/footer.php')
?>

</html>

</html>
