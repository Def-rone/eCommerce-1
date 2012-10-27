<?php session_start(); 
//$_SESSION['username'] = 'sss';

$connect = mysql_connect("localhost","root","");
$result = mysql_select_db("my_db",$connect);



/* 
 * credit_card_number
 * holder_name
 * address1
 * address2
 * city
 * state
 * zipcode
 */

if(!isset($_REQUEST['credit_card_number']) ||
        !isset($_REQUEST['holder_name']) ||
        !isset($_REQUEST['address1']) ||
        !isset($_REQUEST['address2']) ||
        !isset($_REQUEST['city']) ||
        !isset($_REQUEST['state']) ||
        !isset($_REQUEST['zipcode'])){
    echo "invalid data input";
    return;
}

$credit_card_number = $_REQUEST['credit_card_number'];
$holder_name = $_REQUEST['holder_name'];
$address1 = $_REQUEST['address1'];
$address2 = $_REQUEST['address2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$zipcode = $_REQUEST['zipcode'];


//TODO : verify format of inputs;





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

?>
