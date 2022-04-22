<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);
$mensaje = trim($_POST['mensaje']);

$message = file_get_contents('correo.php');
$message = str_replace('%nombre%', $nombre, $message);
$message = str_replace('%email%', $email, $message);
$message = str_replace('%telefono%', $telefono, $message);
$message = str_replace('%mensaje%', $mensaje, $message);

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'email-smtp.us-east-1.amazonaws.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth   = true;
$mail->Username   = 'AKIARCABGFNVR6EAYP44';
$mail->Password   = 'BG1ZoW3ce7roxDNPx4EFTn2/WsH4+0HNgkgbYuhXOb8l';
$mail->setFrom('noreply@textylo.com', 'Info');
$mail->addAddress('blueberryweb7@gmail.com');
$mail->addAddress('notificaciones.goodlock@gmail.com');
$mail->addAddress('carlos.gonzalez.utj@gmail.com');
$mail->Subject = 'Mensaje de la pagina';
$mail->MsgHTML($message);

sleep(5);

if(!$mail->send()) {  
    echo "Message hasn't been sent.";
    echo 'Mailer Error: ' . $mail->ErrorInfo . "n";
} else {
  // sleep(10);
  echo "Mensaje enviado";
//   header("Location: {$_SERVER['HTTP_REFERER']}"); 
exit;
}
