<?php
/*
 * load session cart when a user logs in.
 */
session_start();
ini_set('display_errors', 'On');

if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    
    $dblink = mysql_connect('localhost', 'root', '') or die("Cannot connect mysql");
    mysql_select_db('my_db');
    $query = "select a.inventory_id as inventory_id, a.quantity as quantity, b.items_id as item
                from shopping_cart a, inventory b
                    where a.inventory_id = b.inventory_id
                      and customer_username=\"${_SESSION["username"]}\"";
                     
                      
                      echo $query;
    $result = mysql_query($query);
    
    while($row =  mysql_fetch_array($result)){    
        echo "foreach";
        $inventory_id = $row['inventory_id'];
        $item_record = array('inventory_id' => $row['inventory_id'],
            'quantity' => $row['quantity'],
            'item'=>$row['item']);

        if(!isset($_SESSION['cart'])){ //if shopping cart does not exist, create array and assign to 'cart' variable.
            $_SESSION['cart'] = array($inventory_id => $item_record);
        }else{
            //echo "add to session";
        #TODO: need to add logic to check if there's same item in the shopping cart. If so increase the quantity.
            $_SESSION['cart'][$inventory_id] = $item_record;
        }
    }

    $query1 = "delete from shopping_cart where customer_username=\"${_SESSION['username']}\"";
    
    mysql_query($query1);
    mysql_close($dblink);
    
}
?>
