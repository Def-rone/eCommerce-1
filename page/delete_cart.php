<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<?php
	if(!isset($_REQUEST['inventory_id'])){ 
		echo "error: null value in the request";
		#TODO : return back to the previous page
	}else{
		$inventory_id = $_REQUEST['inventory_id'];
		unset($_SESSION['cart'][$inventory_id]);
	}
?>
<head>
<title>Your Page Title</title>
<meta http-equiv="REFRESH" content="0;url=http://<?php echo $_REQUEST['url'] ?>"></HEAD>
<body>
</body>
</html>
