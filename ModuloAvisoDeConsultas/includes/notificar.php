<?php
require_once __DIR__ . '/mail.php';

function app_notificar_inscriptos(mysqli $conexion, int $idConsulta, string $asunto, string $detalle): int
{
    $consulta = "SELECT a.email, a.nombre, m.nombre_materia, c.fecha_hora
        FROM alumno_consulta ac
        JOIN alumnos a ON a.legajo = ac.legajo_alumno
        JOIN consultas c ON c.id = ac.id_consulta
        JOIN materias m ON m.id = c.id_materia
        WHERE ac.id_consulta = {$idConsulta} AND ac.cancelada = 0";
    $resultado = mysqli_query($conexion, $consulta) or app_die($conexion);
    $enviados = 0;
    while ($fila = $resultado->fetch_assoc()) {
        $cuando = $fila['fecha_hora'];
        $cuerpo = "Hola {$fila['nombre']},\n\n{$detalle}\n\nMateria: {$fila['nombre_materia']}\nFecha y hora: {$cuando}\n";
        if (app_enviar_mail($fila['email'], $asunto, $cuerpo)) {
            $enviados++;
        }
    }
    return $enviados;
}

function app_aviso_mail(): string
{
    if (app_mail_es_demo()) {
        return ' El aviso a los inscriptos quedó registrado en modo demostración (todavía no hay un correo SMTP configurado).';
    }
    return ' Se avisó por correo a los alumnos inscriptos.';
}
