<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<?php
	if(!isset($_REQUEST['item'])){ 
		echo "error: null value in the request";
		#TODO : return back to the previous page
	}else{
		$item = $_REQUEST['item'];
		unset($_SESSION['cart'][$item]);
	}
?>
<head>
<title>Your Page Title</title>
<meta http-equiv="REFRESH" content="0;url=http://<?php echo $_REQUEST['url'] ?>"></HEAD>
<body>
</body>
</html>
