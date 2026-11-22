<?php
require_once __DIR__ . '/includes/bootstrap.php';
    require_app('includes/restringidoAdmin.php')
?>

<!doctype html>
<html lang="en">

<?php
    require_app('templates/header.php')
?>


<div class="container">
    <?php   
        if(isset($_GET["msg"])) {
            echo "
            <div class='alert alert-success margined' role='alert'>
            " . $_GET["msg"] . "
            </div>
            ";
        }
        if(isset($_GET["alert"])) {
            echo "
            <div class='alert alert-danger margined' role='alert'>
            " . $_GET["alert"] . "
            </div>
            ";
        }
    ?>
    <section class="main row">
        <article class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <br>
            <img src="img/perfilVacio.jpg" alt="..." class="img-thumbnail">
            <br>
            <br>
            <h3><?php echo $_SESSION['nombre']; echo ' '; echo $_SESSION['apellido'] ?></h3>
            <h4>Legajo: <?php echo $_SESSION['legajo'] ?></h4>
            <td><button type="button" class="btn btn-outline-secondary" onclick="window.location.href = 'regAlumno.php'">Registrar Nuevo Alumno </button></td>

        </article>

        <aside class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
        <div class="container">

                <div class="titulo">
                    <h2>Alumnos</h2>
                </div>
                <form class="row g-2 mb-3" method="get">
                    <div class="col-md-8">
                        <input class="form-control" type="search" name="q" value="<?php echo app_h($_GET['q'] ?? ''); ?>" placeholder="Buscar por nombre, legajo o email">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </form>

                <div class="div_before_table">
                    <table class="table table-striped table-admin">
                        <thead>
                            <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require app_path('includes/getAllAlumnos.php');
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php echo $paginacion_html ?? ''; ?>
                
            </div>
        </aside>
  
    </section>
</div>

<?php
    require_app('templates/footer.php')
?>

</html>
