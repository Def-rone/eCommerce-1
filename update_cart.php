<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<?php
	if(!isset($_REQUEST['item']) || !isset($_REQUEST['quantity'])) { 
		echo "error: null value in the request";
		#TODO : return back to the previous page
	}else{
		$item = $_REQUEST['item'];
		$quantity = $_REQUEST['quantity'];
		$_SESSION['cart'][$item]['quantity'] = $quantity;
	}
?>
<head>
<meta http-equiv="REFRESH" content="0;url=http://<?php echo $_REQUEST['url'] ?>"></HEAD>
<body>
</body>
</html>
