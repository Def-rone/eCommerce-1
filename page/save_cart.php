<?php
# When a customer logs out, store shopping card information in the database and read them at the next login.
ini_set('display_errors', 'On');
session_start();

$userid = $_SESSION['username'];


if(isset($_SESSION['cart']) && $_SESSION['cart'] != null){
    $dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
    mysql_select_db('my_db') or die('Could not select database');

       foreach($_SESSION['cart'] as $key => $record){
        $query = "INSERT INTO SHOPPING_CART(inventory_id, customer_username, items_id, quantity) values 
                (${key}, '${_SESSION['username']}',  ${record['item']}, ${record['quantity']});";
        mysql_query($query);
echo "$query";
        }
        mysql_close($dblink);
}

?>
<head>
<!--meta http-equiv="REFRESH" content="0;url=http://<?php echo $_SERVER['SERVER_NAME']."Ecommerce/index.php"?>"--></HEAD>
<body>
</body>
</html>
