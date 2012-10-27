<?php session_start(); 
$_SESSION['username'] = 'admin';
$_SESSION['hasCreditInfo']=false;

$connect = mysql_connect("localhost","root","");
$result = mysql_select_db("my_db",$connect);

$sql = mysql_query("SELECT * FROM credit_card WHERE customer_username='$_SESSION[username]';");
$num1 = mysql_num_rows($sql);
$query1 = mysql_fetch_array($sql);
//$sql = mysql_query("SELECT * FROM shipping_addr WHERE customer_username='$_SESSION[username]';");
//$num2 = mysql_num_rows($sql);
//$query2 = mysql_fetch_array($sql);
?>
<html>
<head>
<title>This is Save Checkout page.</title>
<script type="text/javascript" src="jscript.js"></script>
<script>
function makeitfill(){

    document.save_checkout.card_name.value="<?=$query1['holder_name']?>";
    document.save_checkout.shipping_addr.value="<?=$query1['credit_card_number']?>";
    document.save_checkout.card_number.value="<?=$query1['credit_card_number']?>";
    document.save_checkout.exp_date.value="<?=$query1['expiration_date']?>";
    document.save_checkout.billing_addr_1.value="<?=$query1['billing_addr_1']?>";
    document.save_checkout.billing_addr_2.value="<?=$query1['billing_addr_2']?>";
    document.save_checkout.billing_city.value="<?=$query1['billing_city']?>";
    document.save_checkout.billing_state.value="<?=$query1['billing_state']?>";
    document.save_checkout.billing_zipcode.value="<?=$query1['billing_zipcode']?>";
}
</script>
</head>

<body>

<?php
if($num1) //&&$num2
{
    $_SESSION['hasCreditInfo']=true;
    echo("<div id=member align=center style=margin-top:50px>");
    echo("<table><tr><td align=center colspan=2>-- Previous Chechout Information  --</td></tr>
<tr><td>Shipping Address:</td><td>".$query1['holder_name']."</td></tr><tr><td>Card Holder's Name:</td>
<td>".$query1['holder_name']."</td></tr><tr><td>Card Number:</td>
<td>".$query1['credit_card_number']."</td></tr><tr><td> Expiration Date:</td>
<td>".$query1['expiration_date']."</td></tr><tr><td>Billing address:</td><td>".$query1['billing_addr_1'].", ".$query1['billing_addr_2'].
            ", ".$query1['billing_city'].", ".$query1['billing_state']." ".$query1['billing_zipcode']."</td></tr></table>");
    
    echo("</div>");
}
else
{
    echo("<div id=member align=center style=margin-top:70px>");
    echo("</br>");
    echo("</div>");
}   
?>


<div id="member" align="center" style="margin-top:20px">
<form method="post" name="save_checkout" >


<table>
	<tr>
		<td height="40px"><lable for="shipping_addr"> Shipping Address </label></td>
		<td><input type="text" size="40" maxlength="20" name="shipping_addr" id="shipping_addr"></td>
	</tr>
        	<tr>
		<td height="40px"><lable for="shipping_addr_1"> shipping address 1</label></td>
		<td><input type="text" size="40" maxlength="20" name="shipping_addr_1" id="shipping_addr_1"></td>
	</tr>
        	<tr>
		<td><lable for="shipping_addr_2"> shipping address 2</label></td>
		<td><input type="text" size="40" maxlength="20" name="shipping_addr_2" id="shipping_addr_2"></td>
	</tr>
        	<tr>
		<td><lable for="shipping_city"> shipping City </label></td>
		<td><input type="text" size="40" maxlength="20" name="shipping_city" id="shipping_city"></td>
	</tr>
        	<tr>
		<td><lable for="shipping_state"> shipping State </label></td>
		<td><input type="text" size="40" maxlength="20" name="shipping_state" id="shipping_state"></td>
	</tr>
        	<tr>
		<td><lable for="shipping_zipcode"> shipping Zipcode </label></td>
		<td><input type="text" size="40" maxlength="20" name="shipping_zipcode" id="shipping_zipcode"></td>
	</tr>
	<tr>
		<td height="40px"><lable for="card_name"> Card Holder's Name </label></td>
		<td><input type="text" size="40" maxlength="20" name="card_name" id="card_name"></td>
	</tr>
	<tr>
		<td height="40px"><lable for="card_number"> Card Number </label></td>
		<td><input type="text" size="40" maxlength="20" name="card_number" id="card_number" height="10"></td>
	</tr>
	<tr>
		<td height="40px"><lable for="exp_date"> Expiration Date </label></td>
		<td><input type="text" size="40" maxlength="20" name="exp_date" id="exp_date" height="10"></td>
	</tr>
	<tr>
		<td height="40px"><lable for="billing_addr_1"> Billing address 1</label></td>
		<td><input type="text" size="40" maxlength="20" name="billing_addr_1" id="billing_addr_1"></td>
	</tr>
        	<tr>
		<td><lable for="billing_addr_2"> Billing address 2</label></td>
		<td><input type="text" size="40" maxlength="20" name="billing_addr_2" id="billing_addr_2"></td>
	</tr>
        	<tr>
		<td><lable for="billing_city"> Billing City </label></td>
		<td><input type="text" size="40" maxlength="20" name="billing_city" id="billing_city"></td>
	</tr>
        	<tr>
		<td><lable for="billing_state"> Billing State </label></td>
		<td><input type="text" size="40" maxlength="20" name="billing_state" id="billing_state"></td>
	</tr>
        	<tr>
		<td><lable for="billing_zipcode"> Billing Zipcode </label></td>
		<td><input type="text" size="40" maxlength="20" name="billing_zipcode" id="billing_zipcode"></td>
	</tr>
        <tr>
            <?php 
            if($num1) 
            {
                echo("<td><input type='button' value='Previous Info' onClick='makeitfill()'></td>");
            }
		  ?>
                <td><input type="button" value="Save Info" onClick="save_info()">
		</td>
	</tr>

</table>
</form>
</div>

</body>
</html>
