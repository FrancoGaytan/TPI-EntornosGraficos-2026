<?php
require_once __DIR__ . '/includes/bootstrap.php';
?>
<!doctype html>
<html lang="es">

<?php require_app('templates/header.php') ?>

<div class="container acerca">
    <h2>Acerca de nosotros</h2>
    <p>
        Este sitio pertenece a la <strong>Universidad Tecnológica Nacional, Facultad Regional Rosario</strong>,
        y lo usa el Departamento de Ingeniería en Sistemas de Información para organizar las consultas de cátedra.
    </p>
    <p>
        Cada docente publica el día, el horario, la materia y la cantidad de lugares.
        El alumno se anota desde el listado si todavía hay cupo, y puede ver sus próximas consultas y las que ya pasó.
        Si una consulta se bloquea, se cancela o cambia de horario, el inscripto recibe un aviso.
    </p>
    <p>
        La idea es reemplazar el cartel en el pasillo o el mensaje suelto: un solo lugar para saber cuándo cursa la consulta, quién la da y si queda lugar.
    </p>
    <p>
        La facultad está en Zeballos 1341, Rosario.
        El sitio institucional es <a href="https://www.frro.utn.edu.ar/">www.frro.utn.edu.ar</a>.
        Para escribirle al equipo de este sistema, usá la página de <a href="contacto.php">Contacto</a>.
    </p>
</div>

<?php require_app('templates/footer.php') ?>

</html>
