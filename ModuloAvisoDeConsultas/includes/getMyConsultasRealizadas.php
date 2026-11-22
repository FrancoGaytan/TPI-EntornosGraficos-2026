<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/paginacion.php';
require app_path('config/db.php');

$legajoDoc = (int) $_SESSION['legajo'];
$where = "estado != 2 and fecha_hora < curdate() and id_profesor = {$legajoDoc}";
$Cant_por_Pag = 10;
$cuenta = mysqli_query($conexion, "SELECT id FROM consultas WHERE {$where}") or app_die($conexion);
$total_registros = mysqli_num_rows($cuenta);
list($inicio, $pagina, $total_paginas) = paginar($total_registros, $Cant_por_Pag);

echo '<div class="table-responsive"><table class="table table-striped"><thead><tr><th></th><th></th><th>Consulta</th><th>Horario</th></tr></thead><tbody>';

$consulta = "SELECT * FROM consultas WHERE {$where} ORDER BY fecha_hora DESC LIMIT {$inicio}, {$Cant_por_Pag}";
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
        $row2 = $resultado2->fetch_assoc();

        echo "
            <tr>
                <th scope='row'></th>
                <td>  
                </td>
                <td><p>Profesor: " . $row2["nombre"], ' ', $row2["apellido"]. "</p><p>Cupos no ocupados: " . $row["cupo"] . "</p><b>Día de consulta Realizada: " . $fecha . "</b></td>
                <td><b>" . $hora . "</b></td>
            </tr>
        ";
    }
}
else {
    echo "
        <tr>
            <th scope='row'></th>
            <td></td>
            <td><b>No ha realizado consultas</b></td>
            <td></td>
        </tr>
    ";
}

echo '</tbody></table></div>';
enlaces_paginacion($pagina, $total_paginas);
