<?php
require_once __DIR__ . '/includes/bootstrap.php';
    require_app('includes/restringidoAlumno.php');
?>

<!doctype html>
<html lang="en">

<?php
    require_app('templates/header.php')
?>

<div class="container">
    <?php if (!empty($_GET['msg'])): ?>
        <?php $tipo = (isset($_GET['tipo']) && $_GET['tipo'] === 'danger') ? 'danger' : 'success'; ?>
        <div class="alert alert-<?php echo $tipo; ?>" role="alert">
            <?php echo htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>
    <div class="titulo">
        <h2>Listado de Consultas</h2>
    </div>

    <div class="titulo">
        <h4>Bienvenido <?php echo $_SESSION['nombre']; echo ' '; echo $_SESSION['apellido'] ?>!</h4>
    </div>

    <form class="margined" action="listadoConsultas.php" method="get">
        <?php require app_path('config/db.php'); ?>
        <div class="row g-2">
            <div class="col-md-4">
                <label for="idMateria">Materia</label>
                <select class="form-select" name="idMateria" id="idMateria">
                    <option value="">Cualquier materia</option>
                    <?php require_app('includes/getAllMaterias.php') ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="idDocente">Docente</label>
                <select class="form-select" name="idDocente" id="idDocente">
                    <option value="">Cualquier docente</option>
                    <?php
                    $docs = mysqli_query($conexion, 'SELECT legajo, nombre, apellido FROM profesores WHERE activo = 1 ORDER BY apellido, nombre') or app_die($conexion);
                    $docenteElegido = $_GET['idDocente'] ?? '';
                    while ($doc = $docs->fetch_assoc()) {
                        $sel = (string) $docenteElegido === (string) $doc['legajo'] ? ' selected' : '';
                        echo '<option value="' . (int) $doc['legajo'] . '"' . $sel . '>' . app_h($doc['apellido'] . ', ' . $doc['nombre']) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label for="desde">Desde</label>
                <input class="form-control" type="date" name="desde" id="desde" value="<?php echo app_h($_GET['desde'] ?? ''); ?>">
            </div>
            <div class="col-md-2">
                <label for="hasta">Hasta</label>
                <input class="form-control" type="date" name="hasta" id="hasta" value="<?php echo app_h($_GET['hasta'] ?? ''); ?>">
            </div>
        </div>
        <br>
        <button class="btn btn-primary" type="submit" name="filtrar">Buscar</button>
    
    </form>
    
    <?php require app_path('includes/getAllConsultas.php'); ?>
          
</div>

<?php
    require_app('templates/footer.php')
?>

</html>
