<?php 
session_start(); 
ini_set('display_errors', 'On');

//$_SESSION['username'] = 'sss';

if(!isset($_REQUEST['credit_card_number']) ||
        !isset($_REQUEST['holder_name']) ||
        !isset($_REQUEST['cvc']) ||
        !isset($_REQUEST['expiration_date']) ||
        !isset($_REQUEST['billing_address1']) ||
        !isset($_REQUEST['billing_address2']) ||
        !isset($_REQUEST['billing_city']) ||
        !isset($_REQUEST['billing_state']) ||
        !isset($_REQUEST['billing_zipcode'])){
    //$printOut = count($_REQUEST);
    //foreach($_REQUEST as $key => $val)
    //    $printOut .= $key. $val;
    //echo $printOut;
    echo "invalid data input";
    return;
}

$credit_card_number = $_REQUEST['credit_card_number'];
$holder_name = $_REQUEST['holder_name'];
$expiration_date = $_REQUEST['expiration_date'];
$billing_address1 = $_REQUEST['billing_address1'];
$billing_address2 = $_REQUEST['billing_address2'];
$billing_city = $_REQUEST['billing_city'];
$billing_state = $_REQUEST['billing_state'];
$billing_zipcode = $_REQUEST['billing_zipcode'];


$connect = mysql_connect("localhost","root","");
$result = mysql_select_db("my_db",$connect);

//TODO : verify format of inputs;
$sql = "INSERT INTO credit_card (credit_card_number, 
        holder_name, expiration_date, billing_addr_1, billing_addr_2, 
        billing_city, billing_state, billing_zipcode, customer_username) 
        VALUES ('$credit_card_number', '$holder_name',  '$expiration_date',
            '$billing_address1', '$billing_address2', '$billing_city',
            '$billing_state', '$billing_zipcode', '$_SESSION[username]');" ;
    
    $result = mysql_query($sql,$connect);   
    if($result){
        echo "true";
    }else{
        echo $sql;//"Server error. Please try again.";
    }

?>
