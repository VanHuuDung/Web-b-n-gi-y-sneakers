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
require 'class/User.php';
$data = User::getAll();
session_start();

if(isset($_GET["username"])){
    $user = $_GET["username"];
    User::delete($user);
}

require 'inc/header.php';
?>
<?php if (!isset($_SESSION['log_detail'])) : ?>
    <h1 style="text-align: center; color: red; padding-top: 170px;">Bạn cần đăng nhập</h1>
<?php else : ?>
    <?php if ($_SESSION['log_detail'] == "0") : ?>
        <h1 style="text-align: center; color: red; padding-top: 170px;">Bạn không có quyền truy cập</h1>
    <?php else : ?>
        <table style="margin-top: 170px;" class="table table-success">
            <thead class="table-dark">
                <tr>
                    <?php foreach ($data[0] as $key => $value) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach; ?>
                    <td></td>
                </tr>
            </thead>
            <tbody style="font-size: 15dp;">
                <?php foreach ($data as $pro) : ?>
                    <tr>
                        <?php foreach ($pro as $key => $value) : ?>
                            <?php if ($key == 'isadmin') : ?>
                                <?php if ($value == '1') : ?>
                                    <td>Admin</td>
                                <?php else : ?>
                                    <td>User</td>
                                <?php endif; ?>
                            <?php else : ?>
                                <td><?= $value ?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <td>
                            <a style="height: 30px; margin-top: -4px;" href="quantriuser.php?username=<?= $pro->username ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>
<?php require 'inc/footer.php'; ?>