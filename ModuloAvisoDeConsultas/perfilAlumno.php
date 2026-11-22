<?php
require_once __DIR__ . '/includes/bootstrap.php';
    require_app('includes/restringidoAlumno.php')
?>

<!doctype html>
<html lang="en">

<?php
    require_app('templates/header.php')
?>

<div class="container">
    <section class="main row">
        <article class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <br>
            <img src="img/perfilVacio.jpg" alt="..." class="img-thumbnail">
            <br>
            <br>
            <h3><?php echo $_SESSION['nombre']; echo ' '; echo $_SESSION['apellido'] ?></h3>
            <h4>Legajo: <?php echo $_SESSION['legajo'] ?></h4>

        </article>

        <aside class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
        <div class="container">

                <div class="titulo">
                    <h2>Mis Proximas Consultas</h2>
                </div>

                <?php require app_path('includes/getMyConsultasAlumno.php'); ?>

                <div class="titulo">
                    <h2>Consultas ya atendidas</h2>
                </div>
                <?php require app_path('includes/getHistorialAlumno.php'); ?>

            </div>
        </aside>
  
    </section>
</div>

<?php
    require_app('templates/footer.php')
?>

</html>
