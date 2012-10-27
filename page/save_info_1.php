<?php session_start(); 

$connect = mysql_connect("localhost","root","");
$result = mysql_select_db("my_db",$connect);
$str1 = $_POST["card_number1"];
$str2 = $_POST["card_number2"];
$str3 = $_POST["card_number3"];
$str4 = $_POST["card_number4"];

$str_card_num = $str1.$str2.$str3.$str4;

if($_SESSION['hasCreditInfo']==false)
{
    $sql1 = "INSERT INTO credit_card (credit_card_number, holder_name, expiration_date, billing_addr_1, billing_addr_2, billing_city, billing_state, billing_zipcode, customer_username) VALUES ('$str_card_num', '$_POST[holder_name]',  '$_POST[exp_date]', '$_POST[b_addr1]', '$_POST[b_addr1]', '$_POST[b_city]', '$_POST[b_state]', '$_POST[b_zipcode]', '$_SESSION[username]')" ;
    mysql_query($sql1,$connect);
    $sql2 = "INSERT INTO shipping_address (address1, address2, city, state, zipcode,description, users_userid) VALUES ('$_POST[s_addr1]', '$_POST[s_addr2]', '$_POST[s_city]',  '$_POST[s_state]', '$_POST[s_zipcode]', '$_POST[s_descript]','$_SESSION[username]')" ;
    mysql_query($sql2,$connect);
    echo("<script> window.alert('Saved.'); history.go(-1); </script>");
}
else
{
    $sql1 ="UPDATE credit_card SET credit_card_number='$str_card_num', holder_name='$_POST[holder_name]', expiration_date='$_POST[exp_date]', billing_addr_1='$_POST[b_addr1]', billing_addr_2='$_POST[b_addr2]', billing_city='$_POST[b_city]', billing_state='$_POST[b_state]', billing_zipcode='$_POST[b_zipcode]' WHERE customer_username='$_SESSION[username]'";
    mysql_query($sql1,$connect);
    $sql2 = "UPDATE shipping_address SET address1='$_POST[s_addr1]', address2='$_POST[s_addr2]', city='$_POST[s_city]', state='$_POST[s_state]', zipcode='$_POST[s_zipcode]', description='$_POST[s_descript]' WHERE users_userid='$_SESSION[username]'";
    mysql_query($sql2,$connect);
    echo("<script> window.alert('Updated.'); history.go(-1); </script>");
}


echo("<script> window.alert('Done.'); history.go(-1); </script>");


?>
