<?php
    require 'User.php';

class Auth
{
    public $user;
    public $pass;

    public static function login($user, $pass)
    {
        $pro = User::getOneByUser($user);
            if ($user == $pro->username && password_verify($pass, $pro->password) == true) {
                $_SESSION['log_detail'] = $pro->isadmin;
                $_SESSION['user'] = $pro->username;
                header('location: index.php');
                exit();
            }
        return "Username hoặc password không đúng!!!";
    }

    public static function forget($user, $verification)
    {
        $pro = User::getOneByUser($user);
            if ($user == $pro->username) {
                $_SESSION['KTUser'] = $pro->username;
                $_SESSION['verification'] = $verification;
                User::getVerification($verification, $user);
                
                exit();
            }
        return "Username không tồn tại!!!";
    }

    public static function forget_password($user, $pass)
    {
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        $pro = User::update($user, $pass_hash);
            if ($pro) {
                header('location: login.php');
                exit();
            }
        return "false";
    }


    public static function logout()
    {
        unset($_SESSION['log_detail']);
        header('location: index.php');
        exit();
    }

    public static function Register($user, $pass)
    {
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        $pro = User::insert($user, $pass_hash);
            if ($pro) {
                header('location: login.php');
                exit();
            }
        return "false";
    }

}
