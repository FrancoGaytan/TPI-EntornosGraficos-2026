<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/mail.php';

$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$asunto = trim($_POST['asunto'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

$cfg = app_mail_config();
$destinos = $cfg['contacto'] ?? [app_mail_inbox()];
if (!is_array($destinos) || $destinos === []) {
    $destinos = [app_mail_inbox()];
}

$cuerpo = "Llegó un mensaje desde Consultas UTN.\n\n"
    . "Nombre: {$nombre}\n"
    . "Email: {$email}\n"
    . "Teléfono: {$telefono}\n"
    . "Asunto: {$asunto}\n"
    . "Mensaje:\n{$mensaje}\n";

$enviado = false;
foreach ($destinos as $destino) {
    if (app_enviar_mail((string) $destino, 'Mensaje en Consultas UTN', $cuerpo, $email)) {
        $enviado = true;
    }
}

if ($enviado) {
    echo '<script type="text/javascript">alert("Enviado correctamente"); window.location.href="../contacto.php";</script>';
} else {
    $detalle = app_mail_es_demo()
        ? 'Falta configurar la contraseña de aplicación en config/mail.config.php.'
        : 'No se pudo enviar. Revisá la configuración de correo.';
    echo '<script type="text/javascript">alert(' . json_encode($detalle) . '); window.location.href="../contacto.php";</script>';
}
