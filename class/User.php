<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
require 'Data.php';
class User
{
    public $username;
    public $password; 
    public $isadmin;

    

    public function __construct($username = '', $password = '', $isadmin = 0)
    {
        $this->username = $username;
        $this->password = $password;
        $this->isadmin = $isadmin;
    }


    public static function getAll()
    {
        $data = [];

        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `user`";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $product = new User($row['username'], $row['password'], $row['isadmin']);
                $product->username = $row['username'];
                $product->password = $row['password'];
                $product->isadmin = $row['isadmin'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function getOneByUser($username)
    {
        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `user` WHERE username =:username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $product = new User($row['username'], $row['password'], $row['isadmin']);
                $product->username = $row['username'];
                $product->password = $row['password'];
                $product->isadmin = $row['isadmin'];
                return $product;
            } else {
                return null;
            }
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function insert($Username, $Password)
    {
        $db = new Data();
        $pdo = $db->getConn();
    
        $sql = "INSERT INTO `user`(`username`, `password`) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $Username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $Password, PDO::PARAM_STR);
        
        if($stmt->execute()){
            return $Username;
        }else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function update($Username, $Password)
    {
        $db = new Data();
        $pdo = $db->getConn();
    
        $sql = "UPDATE `user` SET `password`=:password WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $Username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $Password, PDO::PARAM_STR);
        
        if($stmt->execute()){
            return $Username;
        }else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function delete($username)
    {
        $db = new Data();
        $pdo = $db->getConn();

        $sql = "DELETE FROM `user` WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header('location:quantriuser.php');
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
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
            $mail->setFrom('vanhuudung02@gmail.com', 'CoLoShop');
            $mail->addAddress($username, 'Dung');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Forget Password';
            $mail->Body    = 'Xin chào,<br/>
             Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu của bạn.<br/>
             Nhập mã đặt lại mật khẩu sau đây: <b>'.$verification.'</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            header('location: forget_password.php');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


}