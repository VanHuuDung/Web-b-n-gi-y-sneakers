<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
class Forget
{
    public $verification;

    public function __construct($verification = 0)
    {
        $this->verification = $verification;
    }

    public static function getVerification($verification, $username)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.elasticemail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'vanhuudung02@gmail.com';                     //SMTP username
            $mail->Password   = '29C69C241A90FA20FF0D491D52440FE2447B';                               //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('CoLoShop@gmail.com', 'CoLoShop');
            $mail->addAddress($username, '');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Forget Password';
            $mail->Body    = 'Xin chào,<br/>
             Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu của bạn.<br/>
             Nhập mã đặt lại mật khẩu sau đây: <b>'.$verification.'</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
