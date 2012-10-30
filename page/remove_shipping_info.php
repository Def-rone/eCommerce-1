<?php
session_start();
ini_set('display_errors', 'On');

$connect = mysql_connect("localhost","root","");
$result = mysql_select_db("my_db",$connect);

if(!isset($_REQUEST['user_address_id'])){
    echo "invalid data input";
    return;
}

$user_address_id = $_REQUEST['user_address_id'];

$sql = "delete from shipping_address where user_address_id = '$user_address_id' and users_userid = '${_SESSION['username']}'" ;

$result = mysql_query($sql,$connect);

if($result){echo true;}else{echo "server error. try again";}

?>