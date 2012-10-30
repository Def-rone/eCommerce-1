<?php
session_start();
ini_set('display_errors', 'On');

mysql_connect("localhost", "root", "") or die("db error");
mysql_select_db("my_db") or die("db schema error");
$query = "select user_address_id, description, address1, name, address2, city, state, zipcode
            from shipping_address where users_userid = '${_SESSION['username']}'";

$result = mysql_query($query);
$data = array();

while($row = mysql_fetch_array($result)){
    $record = array('description' => $row['description'], 'user_address_id' =>$row['user_address_id']);
    $data[count($data)] = $record;
}

$text = json_encode($data);
echo $text;
?>
