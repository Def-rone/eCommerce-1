<?php session_start();

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include(dirname(__DIR__)."/model/admin.php");
$admin = new Admin();
$arr = $admin ->browseInventory();
?>

<html>
    <head>
        <script type="text/javascript">
            function deleteIn(id)
            {  
                window.location.href = "delete.php?id="+id+"";
            }
            function update(id)
            {  
                window.location.href = "updateForm.php?id="+id+"";
            }
        </script>
    </head>
    <body>
    <table width ="600" align ="center" >
        <tr align ="right"><td><a href ="addForm.php"><img src="add.png" width="50" height="50"/></a></td><td>        
            
            <?php
            if(!isset($_SESSION['username'])||$_SESSION['username']==null)
            {
               echo("<script> window.alert('Illegal Access.');</script>");
               echo("<script> location.href='items.php'; </script>");
            }
            else
            {
                echo ("<a href='logout.php'>LOGOUT</a>");
            }
            ?>
                
            </td></tr>
    </table>
    <table border = "1" align = "center" width ="600">
        <tr align ="center">
            <td>Item ID</td>
            <td>Item Name</td>
            <td>Item Description</td>
            <td>Date Added</td>
            <td>Category</td>
            <td>Brand</td>
            <td>Gender</td>
            <td>Compared price</td>
            <td>Operations</td>
        </tr>
        <tr>
            
        <?php       
            foreach ($arr as $value): ?>
     
        <tr align="center">
            <td><?=$value['item_id'] ?></td>
            <td><?=$value['item_name'] ?></td>
            <td><?=$value['description'] ?></td>
            <td><?=$value['date_added'] ?></td>
            <td><?=$value['category'] ?></td>
            <td><?=$value['brand'] ?></td>
            <td><?=$value['gender'] ?></td>
            <td><?=$value['compared_price'] ?></td>
            <td><img onclick="update(<?=$value['item_id']?>)" src="update.png" height ="30"/>
                <a><img onclick="deleteIn(<?=$value['item_id']?>)" src="delete.png" height ="30"/></a></td>
        </tr>
        
        <?php        endforeach; ?>
    </table>
    </body>
</html>
