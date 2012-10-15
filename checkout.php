<?php

# checkout.php
# Takes in items, payment, and shipping information, and create order table.
# is it coming from session ?

$$_REQUEST[''];

# the credit card has been compromised - check the Credit Card Hot List


#check out inventory table and confirm whether price and quantity match.

$dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
mysql_select_db('ecommerce') or die('Could not select database');


if (isset($_SESSION['cart']) && $_SESSION['cart'] != null && $_SESSION['userid'] != null) {

    mysql_query("set autocommit=0");
    mysql_query("start transaction");
    $userid = $_SESSION['userid'];

    try {

        foreach ($_SESSION['cart'] as $key) {
            mysql_query("insert into order_detail () values ()");
        }
    } catch (mysqli_sql_exception $e) {
        mysql_query("ROLLBACK");
    }

    $query = "insert into order ";
    
    
}
?>
