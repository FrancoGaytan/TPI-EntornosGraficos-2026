<?php
require_once __DIR__ . '/bootstrap.php';

function app_mail_config(): array
{
    $path = app_path('config/mail.config.php');
    if (is_file($path)) {
        $cfg = require $path;
        if (is_array($cfg)) {
            return $cfg;
        }
    }
    return ['modo' => 'demo'];
}

function app_mail_es_demo(): bool
{
    $cfg = app_mail_config();
    if (($cfg['modo'] ?? 'demo') !== 'smtp') {
        return true;
    }
    return trim((string) ($cfg['pass'] ?? '')) === '' || trim((string) ($cfg['user'] ?? '')) === '';
}

function app_mail_inbox(): string
{
    return trim((string) (app_mail_config()['inbox'] ?? ''));
}

function app_destino_entregable(string $destino): string
{
    $destino = trim($destino);
    $inbox = app_mail_inbox();
    if ($inbox !== '' && preg_match('/@demo\.frro\.utn\.edu\.ar$/i', $destino)) {
        return $inbox;
    }
    return $destino;
}

function app_enviar_mail(string $destino, string $asunto, string $cuerpo, string $replyTo = ''): bool
{
    $destino = app_destino_entregable($destino);
    if ($destino === '' || !filter_var($destino, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    $cfg = app_mail_config();
    if (app_mail_es_demo()) {
        $dir = app_path('logs');
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $linea = date('c') . "\t{$destino}\t{$asunto}\n{$cuerpo}\n---\n";
        file_put_contents($dir . '/mail.log', $linea, FILE_APPEND);
        $GLOBALS['mail_error'] = 'Falta la contraseña de aplicación en config/mail.config.php.';
        return false;
    }

    require_once app_path('lib/PHPMailer/src/Exception.php');
    require_once app_path('lib/PHPMailer/src/PHPMailer.php');
    require_once app_path('lib/PHPMailer/src/SMTP.php');

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $cfg['host'] ?? 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $cfg['user'];
        $mail->Password = $cfg['pass'];
        $mail->SMTPSecure = $cfg['secure'] ?? 'tls';
        $mail->Port = (int) ($cfg['port'] ?? 587);
        $mail->CharSet = 'UTF-8';
        $mail->setFrom($cfg['from'] ?? $cfg['user'], $cfg['from_name'] ?? 'Consultas UTN');
        $mail->addAddress($destino);
        $inbox = app_mail_inbox();
        if ($inbox !== '' && strcasecmp($inbox, $destino) !== 0) {
            $mail->addBCC($inbox);
        }
        if ($replyTo !== '' && filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
            $mail->addReplyTo($replyTo);
        }
        $mail->Subject = $asunto;
        $mail->Body = $cuerpo;
        $mail->send();
        $GLOBALS['mail_error'] = '';
        return true;
    } catch (Throwable $e) {
        $GLOBALS['mail_error'] = $e->getMessage();
        error_log('Mail: ' . $e->getMessage());
        return false;
    }
}
