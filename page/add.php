<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include(dirname(__DIR__)."/model/admin.php");
$admin = new Admin();
$array = $_POST;
$admin ->addInventory($array);
header("Location: adminIndex.php");
?>
