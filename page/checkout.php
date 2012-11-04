<?php
session_start();
ini_set('display_errors', 'On');

# checkout.php
# Takes in items, payment, and shipping information, and create order table.
//foreach($_REQUEST as $key => $val)
//    echo $key. " ";

if(!isset($_REQUEST['credit_card_number']) ||     
   !isset($_REQUEST['expiration_date'])  ||
   !isset($_REQUEST['holder_name'])  ||
   !isset($_REQUEST['cvs'])  ||
   !isset($_REQUEST['billing_address1'])  ||
   !isset($_REQUEST['billing_address2'])  ||
   !isset($_REQUEST['billing_state'])  ||
   !isset($_REQUEST['billing_city'])  ||
   !isset($_REQUEST['billing_zipcode']) 
        ){
    echo '<html><head>
<title>Your Page Title</title>
<!--meta http-equiv="REFRESH" content="0;url=payment_info.php"></HEAD-->
<body>
Error - Input credit card is incorrect
</body>
</html>
';
    return false;
    
}

//payment information
$credit_card_id = isset($_REQUEST['credit_card_id'])?$_REQUEST['credit_card_id']:null;
$credit_card_number = $_REQUEST['credit_card_number'];
$expiration_date= $_REQUEST['expiration_date'];
$holder_name = $_REQUEST['holder_name'];
$cvs = $_REQUEST['cvs'];
$billing_address1 = $_REQUEST['billing_address1'];
$billing_address2 = $_REQUEST['billing_address2'];
$billing_state = $_REQUEST['billing_state'];
$billing_city = $_REQUEST['billing_city'];
$billing_zipcode = $_REQUEST['billing_zipcode'];


// input validation
//if(!preg_match("^[0-9]{10}$", $credit_card_number)){
    
//}

if(!isset($_REQUEST['description']) ||
   !isset($_REQUEST['recipient_name']) ||        
   !isset($_REQUEST['recipient_address1']) ||     
   !isset($_REQUEST['recipient_address2'])  ||
   !isset($_REQUEST['recipient_state'])  ||
   !isset($_REQUEST['recipient_city'])  ||
   !isset($_REQUEST['recipient_zipcode'])){
    echo '<html><head>
<title>Your Page Title</title>
<!--meta http-equiv="REFRESH" content="0;url=payment_info.php"></HEAD-->
<body> Error - input for shipping info is incorrect.
</body>
</html>
';
    return false;
}

//shipping information
$description = isset($_REQUEST['description'])?$_REQUEST['description']:null;
$user_address_id = isset($_REQUEST['user_address_id'])?$_REQUEST['user_address_id']:null;
$recipient_name = $_REQUEST['recipient_name'];
$recipient_address1 = $_REQUEST['recipient_address1'];
$recipient_address2 = $_REQUEST['recipient_address2'];
$recipient_state = $_REQUEST['recipient_state'];
$recipient_city = $_REQUEST['recipient_city'];
$recipient_zipcode = $_REQUEST['recipient_zipcode'];



// TODO: input validation


# the credit card has been compromised - check the Credit Card Hot List


#check out inventory table and confirm whether price and quantity match.

$dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
mysql_select_db('my_db') or die('Could not select database');


if (isset($_SESSION['cart']) && $_SESSION['cart'] != null && isset($_SESSION['username']) && $_SESSION['username'] != null) {

    mysql_query("set autocommit=false");
    mysql_query("start transaction");
    $userid = $_SESSION['username'];
    $result = true;
    
    try{
        if($user_address_id == null || $user_address_id == ""){
            $result = mysql_query("INSERT INTO SHIPPING_ADDRESS 
                (description,name,address1,address2,state,city,zipcode)
                    VALUES ($description,$recipient_name,$recipient_address1,$recipient_address2,
                            $recipient_state,$recipient_city,$recipient_zipcode);");
            if(!$result){
                echo "Insertion fail(Shipping Address)";
                mysql_query("rollback");
                return;
                
            }
            $user_address_id = mysql_insert_id($dblink);
        }
        if($credit_card_id == null || $credit_card_id == ""){
            $result = mysql_query("INSERT INTO CREDIT_CARD 
                (credit_card_number,holder_name,expiration_date,cvs,billing_addr_1,
                billing_addr_2,billing_city, billing_state, billing_zipcode)
                    VALUES ($credit_card_number,$holder_name,$expiration_date,
                            $cvs,$billing_address1,$billing_address2,
                            $billing_city,$billing_state,$billing_zipcode);");
            if(!$result){
                echo "Insertion fail(Payment Information) - ". mysql_error();
                mysql_query("rollback");
                return;
                
            }

            $credit_card_id = mysql_insert_id($dblink);
        }

        // Don't trust sessioned or incoming information. Check with db for price.
        $totalPrice = 0;
        $cart = $_SESSION['cart'];

        foreach($cart as $key => $vals){
            $totalPrice += $vals['quantity'] * $vals['price'];
        }
        
        $result = mysql_query("insert into orders (order_date,users_userid,user_address_id,credit_card_num,total_price) 
                    values (now(), '${_SESSION['username']}', '$user_address_id', '$credit_card_id', '$totalPrice');");
            if(!$result){
                echo "Insertion fail(Order) - ". mysql_error();
                mysql_query("rollback");
                return;
            
            }

            $order_id = mysql_insert_id($dblink);
        
        

        foreach($cart as $key => $vals){
            $result = mysql_query("insert into order_items (order_id, cart_cart_id,
                         quantity,price,inventory_inventory_id) values ($order_id, '', '${vals['quantity']}', 
                         '${vals['price']}', '${vals['inventory_id']}');") or new Exception("Insert order detail information failed");
            if(!$result){
                echo "Insertion fail(Order Item) - ". mysql_error();
                mysql_query("rollback");
                return;
            }
        }
        
        $result = mysql_query("insert into order_status (order_id, order_status, created_by) 
                    values ($order_id, 'requested', '${_SESSION['username']}');");
        if(!$result){
            echo "Insertion fail(Order Status)  - ". mysql_error();
            mysql_query("rollback");
            return;
        }

        unset($_SESSION['cart']);
        mysql_query("COMMIT;");
        echo "COMMIT";
    } catch (Exception $e) {
        echo $e;
        echo "ROLLBACK";
        mysql_query("ROLLBACK");
    } catch(mysqli_sql_exception $e1){
        echo "ROLLBACK";
        mysql_query("ROLLBACK");
    }
    mysql_close($dblink);
    echo "done";
}
?>