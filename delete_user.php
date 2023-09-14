<?php
  if(isset($_GET["username"])){
    $username = $_GET["username"];
}

require 'Class/User.php';

$db = new Data();
$pdo = $db->getConn();
$kt = User::delete($username);
if($kt){
    header('location: quantriuser.php');
}
