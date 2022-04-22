<?php  
//Composer's autoload file loads all necessary files

  require 'PhpMailer/vendor/autoload.php';

  $nombre = trim($_POST['nombre']);
  $email = trim($_POST['email']);
  $telefono = trim($_POST['telefono']);
  $mensaje = trim($_POST['mensaje']);
  
  $message = file_get_contents('correo.php');
  $message = str_replace('%nombre%', $nombre, $message);
  $message = str_replace('%email%', $email, $message);
  $message = str_replace('%telefono%', $telefono, $message);
  $message = str_replace('%mensaje%', $mensaje, $message);

  $mail = new PHPMailer(true); 

  $mail->isSMTP();  // Set mailer to use SMTP
  $mail->Host = 'smtp.mailgun.org';  // Specify mailgun SMTP servers
  $mail->SMTPAuth = true; // Enable SMTP authentication
  $mail->Username = 'postmaster@blueberryvideo.mx	'; // SMTP username from https://mailgun.com/cp/domains
  $mail->Password = '96d02e124989a8610209bdda9eb20a3c-38029a9d-7e4583da'; // SMTP password from https://mailgun.com/cp/domains
  $mail->SMTPSecure = 'tls';   // Enable encryption, 'ssl'
  $mail->Port= '587';
  $mail->From = 'postmaster@blueberryvideo.mx	'; // The FROM field, the address sending the email 
  $mail->FromName = 'Blueberry'; // The NAME field which will be displayed on arrival by the email client
  $mail->addAddress('blueberryweb7@gmail.com');
  $mail->addAddress('notificaciones.goodlock@gmail.com');
  $mail->addAddress('carlos.gonzalez.utj@gmail.com');     // Recipient's email address and optionally a name to identify him
  $mail->isHTML(true);   // Set email to be sent as HTML, if you are planning on sending plain text email just set it to false
  // The following is self explanatory
  $mail->Subject = 'Mensaje de la pagina';
  
  $mail->MsgHTML($message);
  
  
  sleep(5);

  if(!$mail->send()) {  
      echo "Message hasn't been sent.";
      echo 'Mailer Error: ' . $mail->ErrorInfo . "n";
  } else {
    // sleep(10);
    header("Location: {$_SERVER['HTTP_REFERER']}"); 
  exit;
  }

?>

