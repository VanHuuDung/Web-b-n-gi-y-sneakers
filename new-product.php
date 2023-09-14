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
require 'class/Data.php';
require 'class/Brand.php';
session_start();

$db = new Data();
$pdo = $db->getConn();

$brand = Brand::getBrands();
$gender = Brand::getGender();

require 'inc/header.php';


$NameError = '';
$DescError = '';
$PriceError = '';

$Desc = '';
$Name = '';
$Price = '';
$Gendersid = '';
$Brandsid = '';
$PriceDiscount = '';
$ShowOnHomePage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Desc = $_POST['des'];
    $Name = $_POST['name'];
    $Price = $_POST['price'];
    $PriceDiscount = $_POST['pricediscount'];
    $Gendersid = $_POST['gendersid'];
    $Brandsid = $_POST['brandsid'];
    if (isset($_POST['show']))
        $ShowOnHomePage = 1;
    else
        $ShowOnHomePage = 0;


    // $data = $_SESSION['data'];

    if (empty($_POST['name'])) {
        $NameError = "Name Is ReQuired";
    } else {
        $Name = $_POST["name"];
        if (!preg_match("/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i", $Name)) {
            $NameError = "Only Characters,Numberic and Space Only !";
        }
    }
    if (empty($_POST["des"])) {
        $DescError = "Description Is ReQuired";
    } else {
        $Desc = $_POST["des"];
        if (!preg_match("/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i", $Desc)) {
            $DescError = "Only Characters,Numberic and Space Only !";
        }
    }
    if (empty($_POST["price"])) {
        $PriceError = "Price Is Required";
    } else {
        $Price = $_POST["price"];
        if (!preg_match("/^\\d+$/", $Price)) {
            $PriceError = "Number Only !";
        } else if ($Price % 1000 != 0) {
            $PriceError = "Giá Phải Là Số Nguyên Và chia hết cho 1000";
        }
    }
    if (!$NameError && !$DescError && !$PriceError) {
        $db = new Data();

        try {
            if (empty($_FILES['file'])) {
                throw new Exception('Invalid upload');
            }

            switch ($_FILES['file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('No file uploaded');
                default:
                    throw new Exception('An error occured');
            }

            if ($_FILES['file']['size'] > 1000000) {
                throw new Exception('File too large');
            }

            $mime_types = ['image/png', 'image/jpeg', 'image/gif'];
            $file_info = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($file_info, $_FILES['file']['tmp_name']);
            if (!in_array($mime_type, $mime_types)) {
                throw new Exception('Invalid file type');
            }

            $pathinfo = pathinfo($_FILES['file']['name']);
            // $fname = $pathinfo['filename'];
            $fname = 'image';
            $extension = $pathinfo['extension'];

            $dest = 'images/' . $fname . '.' . $extension;
            $Image = $fname . '.' . $extension;
            $i = 1;
            while (file_exists($dest)) {
                $dest = 'images/' . $fname . "-$i." . $extension;
                $Image = $fname . "-$i." . $extension;
                $i++;
            }

            $id = $db->insert($Name, $Image, $Gendersid, $Desc, $Price, $PriceDiscount, $ShowOnHomePage, $Brandsid);
            if ($id) {
                header('location: product.php?id=' . $id);
            }

            if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
                echo "Thêm ảnh thành công";
            } else {
                throw new Exception('Unable to move file.');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}


?>

<?php require 'inc/header.php' ?>
<?php if (!isset($_SESSION['log_detail'])) : ?>
    <h1 style="text-align: center; color: red; padding-top: 170px;">Bạn cần đăng nhập</h1>
<?php else : ?>
    <?php if ($_SESSION['log_detail'] == "0") : ?>
        <h1 style="text-align: center; color: red; padding-top: 170px;">Bạn không có quyền thêm sản phẩm</h1>
    <?php else : ?>
        <h2 style="padding-top: 170px;">Thêm sản phẩm mới</h2>
        <form method="post" enctype="multipart/form-data" class="w-50 m-auto">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" id="name" name="name" />
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Description</label>
                <input class="form-control" id="des" name="des" />
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Price</label>
                <input class="form-control" id="price" name="price" />
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">PriceDiscount</label>
                <input class="form-control" id="pricediscount" name="pricediscount" />
            </div>

            <div style="margin-top:20px; margin-left: -15px;" class="form-group">
                <div class="col-md-10">
                    <select class="form-control" name="brandsid" id="brandsid">
                        <option value="">Select Brands</option>
                        <?php foreach ($brand as $key => $value) : ?>
                            <?php foreach ($value as $key1 => $value1) : ?>
                                <?php if ($key1 == 'BrandsName') : ?>
                                    <?php if ($value1 == "Nike") : ?>
                                        <option value="1"><?= $value1 ?></option>
                                    <?php else : ?>
                                        <option value="2"><?= $value1 ?></option>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div style="margin-top:20px; margin-left: -15px;" class="form-group">
                <div class="col-md-10">
                    <select class="form-control" name="gendersid" id="gendersid">
                        <option value="">Select Genders</option>
                        <?php foreach ($gender as $key => $value) : ?>
                            <?php foreach ($value as $key1 => $value1) : ?>
                                <?php if ($key1 == 'BrandsName') : ?>
                                    <?php if ($value1 == "Nike") : ?>
                                        <option value="1"><?= $value1 ?></option>
                                    <?php else : ?>
                                        <option value="2"><?= $value1 ?></option>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Show On Home Page</label>
                <input type="checkbox" id="show" name="show" />
            </div>
            <div>
                <label for="file">Image file</label>
                <input id="file" name="file" type="file" />
            </div>
            <button type="submit" name="submit" value="Submit" class="btn btn-primary">Add new</button>
        </form>
    <?php endif; ?>
<?php endif; ?>

<?php require 'inc/footer.php' ?>