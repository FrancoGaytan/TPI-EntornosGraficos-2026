<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/paginacion.php';
require app_path('config/db.php');

$where = "WHERE estado = 1 and fecha_hora > curdate()";

if (isset($_GET['idMateria']) && $_GET['idMateria'] !== '') {
    $filtroMateria = (int) $_GET['idMateria'];
    $where .= " and id_materia = $filtroMateria";
}
if (isset($_GET['idDocente']) && $_GET['idDocente'] !== '') {
    $filtroDocente = (int) $_GET['idDocente'];
    $where .= " and id_profesor = $filtroDocente";
}
if (!empty($_GET['desde']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['desde'])) {
    $where .= " and fecha_hora >= '{$_GET['desde']} 00:00:00'";
}
if (!empty($_GET['hasta']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['hasta'])) {
    $where .= " and fecha_hora <= '{$_GET['hasta']} 23:59:59'";
}

$Cant_por_Pag = 10;
$cuenta = mysqli_query($conexion, "SELECT id FROM consultas $where") or app_die($conexion);
$total_registros = mysqli_num_rows($cuenta);
list($inicio, $pagina, $total_paginas) = paginar($total_registros, $Cant_por_Pag);

echo '<div class="table-responsive"><table class="table table-striped"><thead><tr><th></th><th></th><th>Consulta</th><th>Horario</th></tr></thead><tbody>';

$consulta = "SELECT * FROM consultas $where ORDER BY fecha_hora ASC LIMIT $inicio, $Cant_por_Pag";
$resultado = mysqli_query($conexion, $consulta) or app_die($conexion);

if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $formatoInput = 'Y-m-d H:i:s';
        $fechaHora = DateTime::createFromFormat($formatoInput, $row["fecha_hora"]);
        $hora = $fechaHora -> format('H:i');
        $fecha = $fechaHora -> format('d-m-Y');

        $legProf = $row["id_profesor"];
        $consulta2="SELECT nombre, apellido FROM profesores WHERE legajo = {$legProf};";
        $resultado2=mysqli_query($conexion,$consulta2) or app_die($conexion);
        while($row2 = $resultado2->fetch_assoc()) {

            $idMateria = $row["id_materia"];

            $consulta3="SELECT nombre_materia FROM materias WHERE id = {$idMateria};";
            $resultado3=mysqli_query($conexion,$consulta3) or app_die($conexion);
            while($row3 = $resultado3->fetch_assoc()) {
                echo "
                    <tr>
                        <th scope='row'></th>
                        <td>
                ";
                if ($row["cupo"] > 0) {
                    echo "<a onClick=\"javascript: return confirm('Estas seguro que desea inscribirse a la consulta de " . $row2["nombre"], ' ', $row2["apellido"]. "?');\" href='acciones/inscribirAlumno.php?id=".$row['id']."'>Inscribirse</a>";
                } else {
                    echo "<p>Consulta sin cupo</p>";
                }
                echo"
                        </td>
                        <td> <p><b>Materia: " . $row3["nombre_materia"]. "</b> <p>Profesor: " . $row2["nombre"], ' ', $row2["apellido"]. "</p><p>Cupos Disponibles: " . $row["cupo"]. "</p> Día de consulta: " . $fecha . "</p> </td>
                        <td><b>" . $hora . "</b></td>
                    </tr>
                ";
            }
        }
    }
}
else {
    echo "
        <tr>
            <th scope='row'></th>
            <td></td>
            <td><b>No hay consultas disponibles</b></td>
            <td></td>
        </tr>
    ";
}

echo '</tbody></table></div>';
enlaces_paginacion($pagina, $total_paginas);
