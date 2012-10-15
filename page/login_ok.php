<?php session_start();

$connect = mysql_connect("localhost","root","");
$result = mysql_select_db("my_db",$connect);

if(!$result){
	echo("<script> window.alert('This username does not exist. Please register.'); history.go(-1); </script>");
	}
else
{
	$sql = mysql_query("SELECT * FROM customer WHERE username='$_POST[id]' AND password='$_POST[pw]';");
	$num = mysql_num_rows($sql);
	$query = mysql_fetch_array($sql);
	
	
	if($num)
	{
		echo("<script> window.alert('Welcome.'); </script>");
                $_SESSION['username'] = $query['username'];
                $_SESSION['role'] = $query['role'];
	}
	else
	{
		echo("<script> window.alert('Username or password is incorrect.'); history.go(-1); </script>");
		return;
	}
	

        
	if($query['role']=="admin")
	{
		echo("<script> location.href='adminIndex.php'; </script>");
		
	}

	//$sess_username = $query[username];
	//$sess_role = $query[role];
	//session_register($sess_username);
	//session_register($sess_role);
	
	
	
	//Just for test
	//var_dump($_SESSION);
        
        echo("<script> location.href='items.php'; </script>");

}
	
mysql_close($connect);

?>
		