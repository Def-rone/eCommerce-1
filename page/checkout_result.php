<?php
session_start();
ini_set('display_errors', 'On');

if(!isset( $_REQUEST['order_id']) || $_REQUEST['order_id'] == "" || $_REQUEST['order_id']  == null){
    echo "invalid access to order summary page";
    return;
}

$order_id = $_REQUEST['order_id'];

$dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
mysql_select_db('my_db') or die('Could not select database');

mysql_query("")




?>
<html>
    <head></head>
    <body>
        Order Summary
        
        Payment information
        Shipping information
        Order items
        
        
        
        


        
    </body>
    
</html>
