<?php
session_start();
ini_set('display_errors', 'On');

mysql_connect("localhost", "root", "") or die("db error");
mysql_select_db("my_db") or die("db schema error");
$query = "select credit_card_id, substr(credit_card_number, -4) as credit_card_number
            from credit_card where customer_username = '${_SESSION['username']}'";

$result = mysql_query($query);
$data = array();

while($row = mysql_fetch_array($result)){
    $record = array('credit_card_id' => $row['credit_card_id'], 'credit_card_number' =>$row['credit_card_number']);
    $data[count($data)] = $record;
}

$text = json_encode($data);
echo $text;
?>