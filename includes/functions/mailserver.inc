<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    //Load Composer's autoloader
    require $libraries . '/mailer/autoload.php';

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer();

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'business26.web-hosting.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ahmedelkholy@secureparking.website';                     //SMTP username
    $mail->Password   = ',{c)h6K%gDFz';                               //SMTP password
    $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;          //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Content
    $mail->isHTML(true);                //Set email format to HTML
    $mail->charset="UTF-8";             //To support arabic and english