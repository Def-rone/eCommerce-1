<?php
session_start();
ini_set('display_errors', 'On');
if(!isset($_REQUEST['user_address_id']) || $_REQUEST['user_address_id'] == null) {
    echo "invalid data input!";
    return;
}
$user_address_id = $_REQUEST['user_address_id'];

mysql_connect("localhost", "root", "") or die("db error");
mysql_select_db("my_db") or die("db schema error");
$query = "select user_address_id,description,address1,address2,city,state,zipcode,users_userid,name
            from shipping_address where user_address_id = '$user_address_id' and users_userid = '${_SESSION['username']}'";

$result = mysql_query($query);

$row = mysql_fetch_array($result);
if($row != null){
    $text = json_encode($row);
    echo $text;
}
?>