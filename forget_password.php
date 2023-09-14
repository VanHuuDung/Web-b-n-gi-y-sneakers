<!DOCTYPE html>
<html lang="en">

<head>
    <title>Colo Shop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles/bootstrap4/bootstrap.min.css">
    <link href="css/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="css/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="css/styles/responsive.css">
</head>

<?php
$title = 'Forget Password';
require 'class/Auth.php';
session_start();
$failLogin = '';
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_SESSION['KTUser'];
    $password = $_POST['password'];
    $verification = $_POST['verification'];

    $soNgauNhien = $_SESSION['verification'];
    if ($verification == $soNgauNhien) {
        $failLogin = Auth::forget_password($username, $password);
    } else {
        $failLogin = 'Mã xác nhận không đúng';
    }
}
?>

<?php
require 'inc/header.php';
?>


<div class="container-fluid" style="padding-bottom: 30px;padding-top: 270px">
    <div class="row">
        <div class="m-auto w-50">
            <form method="post">
                <h2 style="text-align: center;">Forget Password</h2>
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Confim Password</label>
                    <input type="password" class="form-control" id="confimpassword" name="confimpassword" placeholder="Enter your confim passord" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Verification</label>
                    <input style="width: 150px;" type="text" class="form-control" id="verification" name="verification" placeholder="Verification" required>
                </div>
                <?php if ($failLogin) : ?>
                    <span class='text-danger fw-bold'><?= $failLogin ?></span>
                <?php endif; ?>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'inc/footer.php' ?>