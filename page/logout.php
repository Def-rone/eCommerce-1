<?php session_start(); 

unset($_SESSION['username']);
unset($_SESSION['role']);

//session_unset();
session_destroy();
//echo "<script language='javascript'>location.href='./inventory_page.php';</script>";
echo("<script> window.alert('Bye.'); </script>");
echo("<script> location.href='items.php'; </script>");
?>