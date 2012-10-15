<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include(dirname(__DIR__)."/model/admin.php");
$admin = new Admin();
$item_id = $_GET['id'];
$arr = $admin ->deleteInventory($item_id);
header("Location: adminIndex.php");
?>
