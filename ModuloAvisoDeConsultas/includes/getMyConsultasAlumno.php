<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/paginacion.php';
require_app('includes/restringidoAlumno.php');

require app_path('config/db.php');

$legajoAlu = (int) $_SESSION['legajo'];
$where = "ac.legajo_alumno = $legajoAlu and ac.cancelada = 0 and c.estado = 1 and c.fecha_hora > curdate()";
$Cant_por_Pag = 10;
$cuenta = mysqli_query($conexion, "SELECT ac.id_consulta FROM alumno_consulta AS ac JOIN consultas AS c ON c.id = ac.id_consulta WHERE $where") or app_die($conexion);
$total_registros = mysqli_num_rows($cuenta);
list($inicio, $pagina, $total_paginas) = paginar($total_registros, $Cant_por_Pag, 'pagina');

echo '<div class="table-responsive"><table class="table table-striped"><thead><tr><th></th><th></th><th>Consulta</th><th>Horario</th></tr></thead><tbody>';

$consultasAlumno = "SELECT * FROM alumno_consulta AS ac
                    JOIN consultas AS c ON c.id = ac.id_consulta
                    WHERE $where
                    ORDER BY c.fecha_hora
                    LIMIT $inicio, $Cant_por_Pag";
$resultado = mysqli_query($conexion, $consultasAlumno) or app_die($conexion);

if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {

        $formatoInput = 'Y-m-d H:i:s';
        $fechaHora = DateTime::createFromFormat($formatoInput, $row["fecha_hora"]);
        $hora = $fechaHora -> format('H:i');
        $fecha = $fechaHora -> format('d-m-Y');

        $legProf = $row["id_profesor"];
        $consulta3="SELECT nombre, apellido FROM profesores WHERE legajo = {$legProf};";
        $resultado3=mysqli_query($conexion,$consulta3) or app_die($conexion);
        while($row3 = $resultado3->fetch_assoc()) {
            
            $idMateria =  $row["id_materia"];
            $consulta4="SELECT nombre_materia FROM materias WHERE id = {$idMateria};";
            $resultado4=mysqli_query($conexion,$consulta4) or app_die($conexion);
            while($row4 = $resultado4->fetch_assoc()) {
                echo "
                    <tr>
                        <th scope='row'></th>
                        <td>
                            <form action='./acciones/cancelarInscripcion.php' method='post'>
                                <input type='hidden' name='id' value='" . $row["id_consulta"] . "'/><br>
                                <input type='hidden' name='legAlumno' value='" . $legajoAlu . "'/><br>
                                <input type='submit' value='Cancelar' />
                            </form>
                        </td>
                        <td><p><b>Nombre Materia: " . $row4["nombre_materia"]. "</b> <p>Profesor: " . $row3["nombre"], ' ', $row3["apellido"]. "</p><p>Cupos Disponibles: " . $row["cupo"] . "</p>Día de consulta: " . $fecha . "</b></td>
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
            <td><b>No tiene consultas</b></td>
            <td></td>
        </tr>
    ";
}

echo '</tbody></table></div>';
enlaces_paginacion($pagina, $total_paginas, 'pagina');
