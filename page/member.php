<?php session_start(); ?> 

<html>
<head>
<title>This is Register page.</title>
<script type="text/javascript" src="jscript.js"></script>
</head>

<body>


<div id="member" align="center" style="margin-top:100px">
<form method="post" name="member_form" action="member_ok.php">


<table>
	<tr>
		<td height="40px"><lable for="id"> Username(*) </label></td>
		<td><input type="text" size="40" maxlength="20" name="id" id="id"></td>
	</tr>
	<tr>
		<td height="40px"><lable for="pw"> Password(*) </label></td>
		<td><input type="password" size="40" maxlength="20" name="pw" id="pw"></td>
	</tr>
	<tr>
		<td height="40px"><lable for="pw_02"> Confirm Password(*) </label></td>
		<td><input type="password" size="40" maxlength="20" name="pw_02" id="pw_02" height="10"></td>
	</tr>
	<tr>
		<td height="40px"><lable for="f_name"> First Name(*) </label></td>
		<td><input type="text" size="40" maxlength="20" name="f_name" id="f_name" height="10"></td>
	</tr>
	<tr>
		<td height="40px"><lable for="l_name"> Last Name(*) </label></td>
		<td><input type="text" size="40" maxlength="20" name="l_name" id="l_name"></td>
	</tr>
	<tr>
		<td height="40px"><lable for="email"> Email(*) </label></td>
		<td><input type="text" size="40" maxlength="45" name="email" id="email"></td>
	</tr>
	<tr>
		<td height="40px"><lable for="birth"> Date of Birth(*)(mm/dd/yyyy)</label></td>
		<td><input type="text" size="40" maxlength="10" name="birth" id="birth"></td>
	</tr>
	<tr>
		<td  height="40px" colspan="2" align="center"><input type="button" value="Done" onClick="join_ok()">
	<input type="reset" value="Reset"></td>
	</tr>
</table>
</form>
</div>

</body>
</html>