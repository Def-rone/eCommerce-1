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

$sql = "SELECT ORDER_ID, ORDER_DATE, USERS_USERID, USER_ADDRESS_ID, CREDIT_CARD_NUM, TOTAL_PRICE
    FROM ORDERS WHERE ORDER_ID = '$order_id';";
$result = mysql_query($sql);

if(!$result){
    echo $result. "<br/>";
    echo "Error while reading order information.";
    return;
}

$row = mysql_fetch_array($result);
$order_date = $row['ORDER_DATE'];
$users_userid = $row['USERS_USERID'];
$user_address_id = $row['USER_ADDRESS_ID'];
$credit_card_num = $row['CREDIT_CARD_NUM'];
$total_price = $row['TOTAL_PRICE'];


$result2 = mysql_query("SELECT USER_ADDRESS_ID, DESCRIPTION, ADDRESS1, ADDRESS2, CITY, STATE, ZIPCODE, NAME
    FROM SHIPPING_ADDRESS WHERE USER_ADDRESS_ID = '".$user_address_id."';");
if(!$result2) {
    echo "Error while reading shipping information";
    return;
}


$row2 = mysql_fetch_array($result2);

$recipient_name = $row2['NAME'];
$recipient_address1 = $row2['ADDRESS1'];
$recipient_address2 = $row2['ADDRESS2'];
$recipient_city = $row2['CITY'];
$recipient_state = $row2['STATE'];
$recipient_zipcode = $row2['ZIPCODE'];


$result3 = mysql_query("SELECT CREDIT_CARD_NUMBER, HOLDER_NAME, EXPIRATION_DATE, BILLING_ADDR_1, 
                        BILLING_ADDR_2, BILLING_CITY, BILLING_STATE, BILLING_ZIPCODE 
    FROM CREDIT_CARD WHERE CREDIT_CARD_ID = '". $credit_card_num. "';");

if(!$result3){
    echo "Error while reading billing information.";
    return;
}

$row3 = mysql_fetch_array($result3);


$credit_card_number = $row3['CREDIT_CARD_NUMBER'];
$holder_name = $row3['HOLDER_NAME'];
$expiration_date = $row3['EXPIRATION_DATE'];
$billing_address1 = $row3['BILLING_ADDR_1'];
$billing_address2 = $row3['BILLING_ADDR_2'];
$billing_city = $row3['BILLING_CITY'];
$billing_state = $row3['BILLING_STATE'];
$billing_zipcode = $row3['BILLING_ZIPCODE'];

?>

<html>
    <head>
        <script type="text/javascript">
            function goBack(){
                location.href="items.php";
            }
        </script>
        
    </head>
    <body>
        <div id="body_div">
            <!-- form name="order_form" action="checkout.php" method="post" -->
            <div id="head">
                <a href="items.php"><img src="logo.jpg" /></a>
            </div>
            <div id="main">
       
            <span class="title">Order Summary</span>
                
<?php echo $order_date ?><br/>
<?php echo $users_userid ?><br/>
<?php echo $credit_card_num ?><br/>
<?php echo $total_price ?><br/>


            <span class="title">Payment information</span>

<?php echo  $credit_card_number ?><br/>
<?php echo $holder_name ?><br/>
<?php echo $expiration_date ?><br/>
<?php echo $billing_address1 ?><br/>
<?php echo $billing_address2 ?><br/>
<?php echo $billing_city ?><br/>
<?php echo $billing_state ?><br/>
<?php echo $billing_zipcode ?><br/>

            <span class="title">Shipping information</span>

<?php $recipient_name ?><br/>
<?php $recipient_address1 ?><br/>
<?php $recipient_address2 ?><br/>
<?php $recipient_city ?><br/>
<?php $recipient_state ?><br/>
<?php $recipient_zipcode ?><br/>


            <span class="title">Order items</span>
            <table>
                
                <tr>
                    
                </tr>
            </table>
<?php
            $sql = "SELECT order_items_id, order_id, cart_cart_id, ORDER_ITEMS.quantity, ORDER_ITEMS.price,
        ITEMS.ITEM_NAME
                FROM ORDER_ITEMS, INVENTORY, ITEMS
                    WHERE ORDER_ID ='$order_id' 
                    and ORDER_ITEMS.INVENTORY_INVENTORY_ID = INVENTORY.INVENTORY_ID
                    and ITEMS.ITEM_ID = INVENTORY.ITEMS_ID";
            
            $result4  = mysql_query($sql);
            if(!$result4){
                echo "No item in the order";
                return;
            }
            
            while($row4 = mysql_fetch_array($result4)){

?>
<?php echo $row4['order_items_id'] ?> 
<?php echo $row4['order_id'] ?> 
<?php echo $row4['quantity'] ?> 
<?php echo $row4['price'] ?> 
<?php echo $row4['ITEM_NAME'] ?><br/> 

            
<?php
            }
?>
                <span class="but"><a href="javascript:goBack();">Back to Shop</a></span>
            </div>
        </div>
    </body>
</html>
