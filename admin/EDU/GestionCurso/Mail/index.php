<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require '../../../../Entidades/variables_globales.php';

if($_REQUEST['mail'])
    $correo = $_REQUEST['mail'];
else
    $correo = '';

if($_REQUEST['mail_cc'])
    $correo_cc = $_REQUEST['mail_cc'];
else
    $correo_cc = [];

if($_REQUEST['pdfDigital'])
    $pdfDigital = $_REQUEST['pdfDigital'];
else
    $pdfDigital = '';

if($_REQUEST['nom_curso'])
    $nom_curso = $_REQUEST['nom_curso'];
else
    $nom_curso = '';

if($_REQUEST['nom_participante'])
    $nom_participante = $_REQUEST['nom_participante'];
else
    $nom_participante = '';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = SMTP_SERVER_CORREO;                     // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = USER_CORREO;                            // SMTP username
    $mail->Password   = PASS_CORREO;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('constancias@inen.sld.pe', utf8_decode('INEN - Constancia'));
    $mail->addAddress($correo);                             // Name is optional

    if(count($correo_cc) > 0) {
        for($index=0; $index < count($correo_cc); $index++) {
            $mail->addCC($correo_cc[$index]);
        }
    }

    $mail->addBCC(USER_CORREO);
    // Attachments
    $mail->addAttachment('../documents/conFirma/'.$pdfDigital.'F.pdf');         // Add attachments

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = utf8_decode('Constancia digital - Departamento de Educación del INEN');
    $mail->Body    = 'Estimado participante: '.utf8_decode($nom_participante).utf8_decode('<br> Reciba esta comunicación en su calidad de participante de la actividad: ').utf8_decode($nom_curso).utf8_decode('.<br><br>Por favor encuentre adjunta la constancia digital que usted ha obtenido al haber completado satisfactoriamente la actividad educativa antes mencionada.<br><br>Podrá comprobar la autenticidad de las constancias digitales del INEN, abriendo el documento en adobe acrobat y visualizando los detalles de la firma digitalizada.<br><br>No responder este correo, si desea realizar alguna consulta escribir a mesadepartesde@inen.sld.pe, para que esta sea derivada.<br><br><b>Departamento de Educación</b><br><b>Instituto Nacional de Enfermedades Neoplásicas</b>');
    
    $mail->AltBody = 'Estimado participante '.utf8_decode($nom_participante).utf8_decode(': Reciba esta comunicación en su calidad de participante de la actividad ').utf8_decode($nom_curso).'. Por favor no responder este correo, si desea realizar alguna consulta escribir a mesadepartesde@inen.sld.pe, para que esta sea derivada.';

    if($mail->send()){
        echo json_encode(array('cod_error' => '1', 'des_error' => 'Message has been sent'));
    }
} catch (Exception $e) {
    echo json_encode(array('cod_error' => '100', 'des_error' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
}