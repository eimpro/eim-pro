<?php
require 'PHPMailer/PHPMailer/PHPMailer.php';
require 'PHPMailer/PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                 
    $mail->isSMTP();                                      
    $mail->Host       = 'smtp.eim-pro.tech';  
    $mail->SMTPAuth   = true;                              
    $mail->Username   = 'eim-pro@eim-pro.tech';                
    $mail->Password   = 'sObBTIC(7';                          
    $mail->SMTPSecure = 'tls';                             
    $mail->Port       = 587;                               

    //Recipients
    $mail->setFrom('eim-pro@eim-pro.tech', 'EIM-PRO');
    $mail->addAddress('eim-pro@eim-pro.tech', 'EIM-PRO');     

    // Content
    $mail->isHTML(true);                                  
    $mail->Subject = $_POST['assunto'];
    $mail->Body    = $_POST['mensagem'];
    $mail->AltBody = strip_tags($_POST['mensagem']);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

