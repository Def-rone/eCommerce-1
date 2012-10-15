<?php 
session_start(); 
ini_set('display_errors', 'On');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <head>
        <meta http-equiv="REFRESH" content="0;url=http://<?php echo $_REQUEST['url'] ?>"></HEAD>
    <body>
    <?php
    
    if (!isset($_REQUEST['inventory_id']) || !isset($_REQUEST['quantity'])) {
        echo "error: null value in the request";
        #TODO : return back to the previous page
    } else {
        $inventory_id = $_REQUEST['inventory_id'];
        $quantity = $_REQUEST['quantity'];
        if(!is_numeric($quantity) || $quantity < 1) {
            echo "Quantity is not numeric value";
        }else{
            $dblink = mysql_connect('localhost', 'root', '') or die("DB Access denied");
            mysql_select_db("my_db") or die("DB schema not selected");
            $query = "select quantity from inventory where inventory_id = $inventory_id";
            $result = mysql_query($query) or die("Cannot get the data");
            $row = mysql_fetch_array($result);
            if ($quantity >= $row['quantity']) {
            }else {            
                $_SESSION['cart'][$inventory_id]['quantity'] = $quantity;
            }
        }
    }
    ?>

    </body>
</html>
