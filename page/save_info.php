<?php session_start(); 
//$_SESSION['username'] = 'sss';

$connect = mysql_connect("localhost","root","");
$result = mysql_select_db("my_db",$connect);

if($_SESSION['hasCreditInfo']==false)
{
    $sql = "INSERT INTO credit_card (credit_card_id, credit_card_number, holder_name, expiration_date, billing_addr_1, billing_addr_2, billing_city, billing_state, billing_zipcode, customer_username) VALUES ('10', '$_POST[card_number]', '$_POST[card_name]',  '$_POST[exp_date]', '$_POST[billing_addr_1]', '$_POST[billing_addr_2]', '$_POST[billing_city]', '$_POST[billing_state]', '$_POST[billing_zipcode]', '$_SESSION[username]')" ;
    mysql_query($sql,$connect);   
    echo("<script> window.alert('first Saved.'); history.go(-1); </script>");
}
else
{
    $sql = mysql_query("UPDATE credit_card SET credit_card_number='xxx', holder_name= 'xxx', expiration_date='xxx'  WHERE customer_username='$_SESSION[username]';");
    mysql_query($sql,$connect);
    echo("<script> window.alert('Saved.'); history.go(-1); </script>");
}

//$sql2 = mysql_query("UPDATE credit_card SET credit_card_number='변수', holder_name= '변수',   WHERE customer_username='$_SESSION[username]';");
//$num2 = mysql_num_rows($sql2);
//$query = mysql_fetch_array($sql);


echo("<script> window.alert('Saved.'); history.go(-1); </script>");


?>
