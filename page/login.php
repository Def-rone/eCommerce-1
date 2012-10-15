<?php session_start(); ?>

<html>
<head>
<title>This is Login page.</title>
<script type="text/javascript" src="jscript.js"></script>
</head>

<body>

<div id="login" style="margin-top:150px">
<form method="post" name="login_form" action="login_ok.php">
<table align="center">
	<tr>
		<td><lable style="visibility:visible;" for="uid"> Username </label>
		</td>
		<td><input type="text" name="id" id="uid" size="20" maxlength="20">
		</td>
	</tr>
	<tr>
		<td><lable style="visibility:visible;" for="upw"> Password </label>
		</td>
		<td><input type="password" name="pw" id="upw" size="20" maxlength="20">
		</td>
	</tr>
</table>
<table align="center">
	<tr>
		<td><input type="button" value="Login" onClick="login()">
		</td>
		<td><input type="button" value="Register" onClick="join()">
		</td>
	</tr>
</table>
</form>
</div>

</body>
</html>
