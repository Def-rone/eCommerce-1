<?php session_start();

function validDateFormat($str)
{ 
    if (substr_count($str, '/') == 2)
	{ 
        list($m, $d, $y) = explode('/', $str); 
        return checkdate($m, $d, sprintf('%04u', $y)); 
    } 
    return false; 
} 

function validateDOB($date)
{
	$minAge = strtotime("-18 YEAR");
	$entrantAge = strtotime($date);
	if($entrantAge > $minAge)
	{
		return false;
	}
	
	return true;
}

function validateEmail($email)
{
	$ereg = "^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)+$"; 
	//$result = eregi(.$ereg,$email);
        $result = preg_match("/".$ereg."/i",$email);
	if($result==1)
	{
		return true;
	}
	else
	{
		return false;
	}
}

	$birth = $_POST["birth"];
	
	if(!validDateFormat($birth))
	{
		echo("<script> window.alert('Date format is incorrect.'); history.go(-1); </script>");
		return;
	}
	
	if(!validateDOB($birth))
	{
		echo("<script> window.alert('You are too young.'); history.go(-1); </script>");
		return;
	}
	
	$email = $_POST["email"];
	
	if(!validateEmail($email))
	{
		echo("<script> window.alert('Your email format is incorrect.'); history.go(-1); </script>");
		return;
	}
	
	$connect = mysql_connect("localhost","root","");
	if(!$connect){
		echo "connection fails";
		//die('Could not connect: ', mysql_error());
	}


	if(strlen($_POST["id"])>20)
	{
		echo("<script> window.alert('Username is too long. It should be less than 21.'); history.go(-1); </script>");
		return;
	}
	elseif(strlen($_POST["pw"])<6)
	{
		echo("<script> window.alert('Password is too short. It should be at least 6 characters.'); history.go(-1); </script>");
		return;
	}
	elseif(strlen($_POST["pw"])>20)
	{
		echo("<script> window.alert('Password is too long. It should be less than 21.'); history.go(-1); </script>");
		return;
	}
	elseif(strlen($_POST["f_name"])>20)
	{
		echo("<script> window.alert('First name is too long. It should be less than 21.'); history.go(-1); </script>");
		return;
	}
	elseif(strlen($_POST["l_name"])>20)
	{
		echo("<script> window.alert('Last name is too long. It should be less than 21.'); history.go(-1); </script>");
		return;
	}
	elseif(strlen($_POST["email"])>45)
	{
		echo("<script> window.alert('Email address is too long. It should be less than 46.'); history.go(-1); </script>");
		return;
	}

	
	mysql_select_db("my_db", $connect);
	
	
	$sql = "INSERT INTO customer (username, password, firstname, lastname, email, phone, role) VALUES ('$_POST[id]', '$_POST[pw]', '$_POST[f_name]',  '$_POST[l_name]', '$_POST[email]', '$_POST[birth]', 'user')" ;
	
	
	$result = mysql_query($sql,$connect);
	
	echo $result;
	
	if(!$result){
		echo ("<script> window.alert('This username is already exist.'); history.go(-1); </script>");
	}
	else{
		echo ("<script> window.alert('Done'); location.href='login.php'; </script>");
	}
	
	mysql_close($connect);
	
?>