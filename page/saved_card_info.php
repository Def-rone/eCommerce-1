<?php
session_start();
ini_set('display_errors', 'On');
if(!isset($_REQUEST['credit_card_id']) || $_REQUEST['credit_card_id'] == null) return;
$creditCardId = $_REQUEST['credit_card_id'];

mysql_connect("localhost", "root", "") or die("db error");
mysql_select_db("my_db") or die("db schema error");
$query = "select credit_card_id, substr(credit_card_number, -4) credit_card_number,
holder_name, expiration_date, billing_addr_1 billing_address1, billing_addr_2 billing_address2, billing_city, billing_state, billing_zipcode, customer_username
            from credit_card where credit_card_id = '$creditCardId' and customer_username = '${_SESSION['username']}'";

$result = mysql_query($query);

$row = mysql_fetch_array($result);
if($row != null){
    $text = json_encode($row);
    echo $text;
}
?>