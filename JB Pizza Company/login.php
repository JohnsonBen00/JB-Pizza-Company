<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="JB.css" />
<title>Login Page</title>
<style>
</style>
</head>
<body>
	<?php
session_start();
?>
	<div id="header"></div>
	<div id="title">
		<h1>
			<i>JB Pizza Company</i>
		</h1>
	</div>
	<br> &nbsp;
	<a class="buttons" href="index.php">Go Back</a>
	<div class="wrap">
		<form action="controller.php" method="POST">
			<br>Username <input type="text" name="username"><br> <br> Password
			&nbsp;<input type="password" name="password"><br> <br> <input
				type="submit" name="login" value="Login"><br> <br>
			
		<?php
if (isset($_SESSION['loginError']))
    echo $_SESSION['loginError'];
?>
		
		</form>
	</div>

</body>
</html>