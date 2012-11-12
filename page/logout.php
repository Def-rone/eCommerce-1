<?php session_start(); 

//$userid = $_SESSION['username'];


if(isset($_SESSION['cart']) && $_SESSION['cart'] != null){
    $dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
    mysql_select_db('my_db') or die('Could not select database');

       foreach($_SESSION['cart'] as $key => $record){
        $query = "INSERT INTO SHOPPING_CART(inventory_id, customer_username, items_id, quantity) values 
                (${key}, '${_SESSION['username']}',  ${record['item']}, ${record['quantity']});";
        mysql_query($query);
        echo "$query".  mysql_error();
        }
        mysql_close($dblink);
}
unset($_SESSION['username']);
unset($_SESSION['role']);

//session_unset();
session_destroy();
//echo "<script language='javascript'>location.href='./inventory_page.php';</script>";
echo("<script> window.alert('Bye.'); </script>");
echo("<script> location.href='items.php'; </script>");
?>