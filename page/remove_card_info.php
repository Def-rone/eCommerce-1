<?php
session_start();
ini_set('display_errors', 'On');

$connect = mysql_connect("localhost","root","");
$result = mysql_select_db("my_db",$connect);

if(!isset($_REQUEST['credit_card_id'])){
    echo "invalid data input";
    return;
}

$credit_card_id = $_REQUEST['credit_card_id'];

$sql = "delete from credit_card where credit_card_id = '$credit_card_id' and customer_username = '${_SESSION['username']}'" ;

$result = mysql_query($sql,$connect);

if($result){echo true;}else{echo "server error. try again";}

?>