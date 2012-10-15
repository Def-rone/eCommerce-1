<?php
# When a customer logs out, store shopping card information in the database and read them on the next login.
ini_set('display_errors', 'On');

session_start();
$dblink = mysql_connect('www.shoppersrate.com', 'ecommerce', 'ecommerce') or die('Could not connect: ' . mysql_error());
mysql_select_db('ecommerce') or die('Could not select database');

$_SESSION['cart'];
$userid = $_SESSION['user'];


if(isset($_SESSION['cart']) && $_SESSION['cart'] != null){
    mysql_query("set autocommit=false");
    try{
       foreach($_SESSION['cart'] as $key){
            mysql_query("INSERT INTO SHOPPING_CART(user_id, item_id, price, quantity) values 
                (" . $userid.", " . $_SESSION['cart'][$key]['item'].", " . $_SESSION['cart'][$key]['price']
                    .", " . $_SESSION['cart'][$key]['quantity'].")");
            $result = mysql_query($query) or die('Shopping cart cannot be saved. Return to <a href=" $_SERVER[SERVER_NAME]."index.php">Home page</a>.  ');
        }
        mysql_query("COMMIT");
    }catch(mysqli_sql_exception $e){
        mysql_query("ROLLBACK");
    }
}
?>
<head>
<meta http-equiv="REFRESH" content="0;url=http://<?php echo $_SERVER['SERVER_NAME']."index.php"?>"></HEAD>
<body>
</body>
</html>
