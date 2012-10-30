<?php
session_start(); 
ini_set('display_errors', 'On');

//$_SESSION['username'] = 'sss';

if(!isset($_REQUEST['description']) ||
        !isset($_REQUEST['recipient_name']) ||
        !isset($_REQUEST['recipient_address1']) ||
        !isset($_REQUEST['recipient_address2']) ||
        !isset($_REQUEST['recipient_city']) ||
        !isset($_REQUEST['recipient_state']) ||
        !isset($_REQUEST['recipient_zipcode'])){
    $printOut = count($_REQUEST);
    foreach($_REQUEST as $key => $val)
        $printOut .= $key. $val;
    echo $printOut;
    echo "invalid data input";
    return;
}

$description = $_REQUEST['description'];
$recipient_name = $_REQUEST['recipient_name'];
$recipient_address1 = $_REQUEST['recipient_address1'];
$recipient_address2 = $_REQUEST['recipient_address2'];
$recipient_city = $_REQUEST['recipient_city'];
$recipient_state = $_REQUEST['recipient_state'];
$recipient_zipcode = $_REQUEST['recipient_zipcode'];

$connect = mysql_connect("localhost","root","");
$result = mysql_select_db("my_db",$connect);


//TODO : verify format of inputs;
$sql = "INSERT INTO shipping_address (description,name, address1,address2,city,state,zipcode,users_userid)
        VALUES ('$description', '$recipient_name',  '$recipient_address1',
            '$recipient_address2', '$recipient_city', '$recipient_state',
            '$recipient_zipcode', '$_SESSION[username]');" ;
    
    $result = mysql_query($sql,$connect);   
    if($result){
        echo "true";
    }else{
        echo $sql;//"Server error. Please try again.";
    }

?>
