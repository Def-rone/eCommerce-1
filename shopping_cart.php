<?php session_start(); ?>
<html>
<head>
<script type="text/javascript">
function update_cart(obj){
	var item = document.getElementsByName("item")[obj].value;
	var quantity = document.getElementsByName("quantity")[obj].value;
	url = "update_cart.php?item=" + item + "&quantity=" + quantity + "&url=<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>";
	location.href=url;
}
</script>
</head>
<body>
	<table>
		<tr>
			<td>Number</td>
			<td>Item</td>
			<td>Quantity</td>
			<td>Price</td>
			<td></td>
		</tr>
<?php
if(!isset($_SESSION['cart']) || $_SESSION['cart'] == null){

?>
		<tr>
			<td colspan="5">No item in the shopping cart.</td>
		</tr>
	<form action="update_cart.php" method="post">
<?php
} else{
	
	$cart = $_SESSION['cart'];
	$index = 0;
	foreach($cart as $item => $val){
		
?>
		<tr>
			<td>a</td>
			<td><input type="hidden" name="item" value="<?php echo $item ?>"/><?php echo $item ?></td>
			<td><input type="text" name="quantity" value="<?php echo $val['quantity'] ?>"/></td>
			<td><?php echo $val['price'] ?></td>
			<td>
				<input type="button" name="update" value="update" onclick="javascript:update_cart(<?php echo $index ?>);"/>
				<input type="button" name="delete" value="delete" 
				onclick='location.href="delete_cart.php?item=<?php echo $item; ?>&url=<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>"'/>
			</td>
		</tr>
<?php
		$index++;
	}
}
?>
		<tr ><td colspan="5" style="align:right">Check Out</td></tr>
	</form>
	</table>
</body>
</html>
