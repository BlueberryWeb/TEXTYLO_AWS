
<?php
$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);
$mensaje = trim($_POST['mensaje']);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

$sender = 'noreply.textylo@gmail.com';
$senderName = 'Pagina TEXTYLO';
$recipient = 'noreply.textylo@gmail.com';
$recipient1 = 'pruebascorreosbb@gmail.com';
$recipient2 = 'ventas01bb@gmail.com';
$recipient3 = 'santiago@textylo.com.mx';
$recipient4 = 'fidelberry1@gmail.com';

$usernameSmtp = 'noreply.textylo@gmail.com';
$passwordSmtp = 'nsteduzmwlfrohcb';
$configurationSet = 'ConfigSet';
$host = 'smtp.gmail.com';
$port = 587;
$subject = 'Mensaje de textylo en la web';
$bodyText =  "Correo de la web";
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


// Ingresa tu clave secreta.....
define("RECAPTCHA_V3_SECRET_KEY", '6LdlllUgAAAAAFgcVYrgvQRqmpM9lIov-EXKQ9oE');
$token = $_POST['token'];
$action = $_POST['action'];

// call curl to POST request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$arrResponse = json_decode($response, true);

// verificar la respuesta
if ($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
    // Si entra aqui, es un humano, puedes procesar el formulario
    try {
        $mail->isSMTP();
        $mail->setFrom($sender, $senderName);
        $mail->Username   = $usernameSmtp;
        $mail->From   = $usernameSmtp;
        $mail->Password   = $passwordSmtp;
        $mail->Host       = $host;
        $mail->Port       = $port;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = 'tls';
        $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);
        $mail->addAddress($recipient);
        $mail->addAddress($recipient1);
        $mail->addAddress($recipient2);
        $mail->addAddress($recipient3);
        $mail->addAddress($recipient4);
        $mail->isHTML(true);
        $mail->Subject    = $subject;
        $mail->Body       = $bodyHtml;
        $mail->AltBody    = $bodyText;
        $mail->Send();
        sleep(4);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } catch (phpmailerException $e) {
        echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
    } catch (Exception $e) {
        echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
    }
} else {
    // Si entra aqui, es un robot....
    echo "Lo siento, parece que eres un Robot";
}
?>