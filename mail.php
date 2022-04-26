
<?php
/**
 * Copyright 2010-2019 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * This file is licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License. A copy of
 * the License is located at
 *
 * http://aws.amazon.com/apache2.0/
 *
 * This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
 * CONDITIONS OF ANY KIND, either express or implied. See the License for the
 * specific language governing permissions and limitations under the License.
 */


$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);
$mensaje = trim($_POST['mensaje']);


// Import PHPMailer classes into the global namespace.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require './vendor/autoload.php';

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$sender = 'noreply.blueberry@gmail.com';
$senderName = 'Pagina Textilo';

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
$recipient = 'pruebas.blueberry2@gmail.com';
$recipient = 'noreply.blueberry@gmail.com';

// Replace smtp_username with your Amazon SES SMTP user name.
$usernameSmtp = 'noreply.blueberry@gmail.com';

// Replace smtp_password with your Amazon SES SMTP password.
$passwordSmtp = 'Blueberry0707';

// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
$configurationSet = 'ConfigSet';

// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
$host = 'smtp.gmail.com';
$port = 587;

// The subject line of the email
$subject = 'Mensaje de textilo en la web';

// The plain-text body of the email
$bodyText =  "Correo de la web";

// The HTML-formatted body of the email
$bodyHtml = '

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="x-apple-disable-message-reformatting" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">
  <title></title>
</head>
<body style="margin:0;padding:0;">
  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
      <td style="padding:0;">
        <table role="presentation" style="font-family: , sans-serif; width:602px;border-collapse:collapse;border:0px solid #cccccc;border-spacing:0;text-align:left;">
          <tr>
            <td align="left" style="font-family: , sans-serif; padding:10px 0 30px 0;">
            <img src="https://i.postimg.cc/VN79rVnD/logo-textylo-colores.gif" alt="TEXTYLO" width="200" style="height:auto;display:block; padding-top: 15px;" />
              <hr>
            </td>
          </tr>
          <tr>
            <td style="font-family: , sans-serif; padding:0px 30px 42px 20px;">
              <table role="presentation" style="font-family: , sans-serif; width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                <tr>
                  <td style="font-family: , sans-serif; padding:0 0 36px 0;color:#153643;">
                  <img src="https://i.postimg.cc/k4Jn15MD/Nuevo-Contacto.png" alt="NUEVO CONTACTO" style="max-width: 500px; margin-left: 50px; margin-bottom: 60px; margin-top: 20px;"/>
                  <center>
                    <h4 style="margin:0 0 12px 0;font-size: 20px; text-align: center; font-family: , sans-serif;">Se ha capturado un nuevo lead en <b style="font-weight: 600; color: black;">TEXTYLO</b></h4>
                    <ul style="color: #aba9a8; list-style: none; text-align: center;">
                    <li style="margin-bottom: 10px;">Nombre: ' . $nombre . '</li>
                    <li style="margin-bottom: 10px;">Correo electrónico: ' . $email . '</li>
                    <li style="margin-bottom: 10px;">Teléfono:  ' . $telefono . '</li>
                    <li style="margin-top: 40px;">Mensaje: ' . $mensaje . '</li>
                </ul>
                  </td>
                </tr>
                
                <tr>
                      <td style="padding:0;">
                        <table role="presentation" style="font-family: , sans-serif; width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                          <tr>
                          <td style="padding:0;">
                        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0; font-family:, sans-serif;">
                          <tr>
                            <td style="width:260px;padding:0;vertical-align:top;color:#000000; font-family:, sans-serif;">
                             
                            </td>
                          </tr>
                        </table>
                      </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                </center>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:30px;background:#000000;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                <tr>
                  <td style="padding:0;width:50%;" align="right">
                    <img src="https://i.postimg.cc/4dpfLLNY/materialized-blueberry.gif" alt="MATERIALIZED BY Blueberry" />
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>
    
    ';

$mail = new PHPMailer(true);

try {
  // Specify the SMTP settings.
  $mail->isSMTP();
  $mail->setFrom($sender, $senderName);
  $mail->Username   = $usernameSmtp;
  $mail->From   = $usernameSmtp;
  $mail->Password   = $passwordSmtp;
  $mail->Host       = $host;
  $mail->Port       = $port;
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = 'tls';
  // $mail->SMTPDebug = true;
  $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

  // Specify the message recipients.
  $mail->addAddress($recipient);
  // You can also add CC, BCC, and additional To recipients here.

  // Specify the content of the message.
  $mail->isHTML(true);
  $mail->Subject    = $subject;
  $mail->Body       = $bodyHtml;
  $mail->AltBody    = $bodyText;
  $mail->Send();
  sleep(5);
  header("Location: {$_SERVER['HTTP_REFERER']}");
} catch (phpmailerException $e) {
  echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
} catch (Exception $e) {
  echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
}

?>












