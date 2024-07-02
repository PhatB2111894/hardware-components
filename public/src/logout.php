<?php 
session_start();

$_SESSION['id'] = null;
$_SESSION['isAdmin'] = null;
session_unset();
session_destroy();
header("location: ../dangnhap.php");