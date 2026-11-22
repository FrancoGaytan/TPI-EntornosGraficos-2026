<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/paginacion.php';
require app_path('config/db.php');

$legajoDoc = (int) $_SESSION['legajo'];
$where = "c.estado != 2 AND c.fecha_hora > CURDATE() AND c.id_profesor = {$legajoDoc}";
$Cant_por_Pag = 10;
$cuenta = mysqli_query($conexion, "SELECT c.id FROM consultas c WHERE {$where}") or app_die($conexion);
$total_registros = mysqli_num_rows($cuenta);
list($inicio, $pagina, $total_paginas) = paginar($total_registros, $Cant_por_Pag);

$consulta = "SELECT c.*, m.nombre_materia
    FROM consultas c
    JOIN materias m ON m.id = c.id_materia
    WHERE {$where}
    ORDER BY c.fecha_hora
    LIMIT {$inicio}, {$Cant_por_Pag}";
$resultado = mysqli_query($conexion, $consulta) or app_die($conexion);

if ($resultado->num_rows === 0) {
    echo '<p class="consulta-vacia">No tenés consultas próximas.</p>';
    enlaces_paginacion($pagina, $total_paginas);
    return;
}

while ($row = $resultado->fetch_assoc()) {
    $fechaHora = DateTime::createFromFormat('Y-m-d H:i:s', $row['fecha_hora']);
    $hora = $fechaHora->format('H:i');
    $fecha = $fechaHora->format('d-m-Y');
    $id = (int) $row['id'];
    $activa = (int) $row['estado'] === 1;

    $inscriptos = mysqli_query($conexion, "SELECT a.legajo, a.nombre, a.apellido
        FROM alumno_consulta ac
        JOIN alumnos a ON a.legajo = ac.legajo_alumno
        WHERE ac.id_consulta = {$id} AND ac.cancelada = 0
        ORDER BY a.apellido, a.nombre") or app_die($conexion);
    $nombres = [];
    while ($alumno = $inscriptos->fetch_assoc()) {
        $nombres[] = '<li>' . app_h($alumno['apellido'] . ', ' . $alumno['nombre']) . ' <span>' . (int) $alumno['legajo'] . '</span></li>';
    }

    echo '<article class="consulta-card">';
    echo '<header class="consulta-card-head">';
    echo '<div><h3>' . app_h($row['nombre_materia']) . '</h3>';
    echo '<p>' . $fecha . ' · ' . $hora . '</p></div>';
    echo '<div class="consulta-meta">';
    echo '<span>' . (int) $row['cupo'] . ' cupos</span>';
    echo $activa ? '<span class="consulta-estado activa">Activa</span>' : '<span class="consulta-estado bloqueada">Bloqueada</span>';
    echo '</div></header>';

    echo '<div class="consulta-inscriptos"><p>Inscriptos</p>';
    if ($nombres) {
        echo '<ul>' . implode('', $nombres) . '</ul>';
    } else {
        echo '<p class="consulta-nadie">Nadie inscripto todavía.</p>';
    }
    echo '</div>';

    if (!$activa && !empty($row['motivo'])) {
        echo '<p class="consulta-motivo">Motivo del bloqueo: ' . app_h($row['motivo']) . '</p>';
    }

    echo '<div class="consulta-acciones">';
    if ($activa) {
        echo '<form class="consulta-accion" action="acciones/blockConsulta.php" method="post">
            <input type="hidden" name="id" value="' . $id . '">
            <input name="motivo" class="form-control" required minlength="5" maxlength="255" placeholder="Motivo del bloqueo">
            <button class="btn btn-outline-primary" type="submit">Bloquear</button>
        </form>';
    } else {
        echo '<form class="consulta-accion" action="acciones/unblockConsulta.php" method="get">
            <input type="hidden" name="id" value="' . $id . '">
            <button class="btn btn-outline-primary" type="submit">Desbloquear</button>
        </form>';
    }
    echo '<form class="consulta-accion" action="acciones/cancelarConsultaDocente.php" method="post">
        <input type="hidden" name="id" value="' . $id . '">
        <input name="motivo" class="form-control" required minlength="5" maxlength="255" placeholder="Motivo de la cancelación">
        <button class="btn btn-outline-danger" type="submit">Cancelar</button>
    </form>';
    echo '<form action="reprogramarConsulta.php" method="post">
        <input type="hidden" name="id" value="' . $id . '">
        <button class="btn btn-outline-secondary" type="submit">Reprogramar</button>
    </form>';
    echo '</div></article>';
}
enlaces_paginacion($pagina, $total_paginas);
