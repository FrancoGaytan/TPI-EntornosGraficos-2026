<?php
require_once __DIR__ . '/includes/bootstrap.php';
    require_app('includes/restringidoDocente.php')
?>

<!doctype html>
<html lang="en">

<?php
    require_app('templates/header.php')
?>

<div class="container">
    <?php
        if (!empty($_GET['msg'])) {
            echo '<div class="alert alert-info margined" role="alert">' . app_h($_GET['msg']) . '</div>';
        }
    ?>
    <section class="row g-4 docente-panel">
        <article class="col-md-3">
            <div class="docente-perfil">
                <img src="img/perfilVacio.jpg" alt="Foto de perfil" class="docente-avatar">
                <h3><?php echo app_h($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></h3>
                <p>Legajo <?php echo app_h((string) $_SESSION['legajo']); ?></p>
                <a class="btn btn-outline-secondary" href="historialConsultasDoc.php">Historial de consultas</a>
            </div>
        </article>

        <aside class="col-md-9">
            <h2 class="docente-titulo">Mis próximas consultas</h2>
            <?php require app_path('includes/getMyConsultas.php'); ?>
        </aside>
    </section>
</div>

<?php
    require_app('templates/footer.php')
?>

</html>
