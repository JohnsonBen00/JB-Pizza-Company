<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="JB.css" />
<title>User Sign-up</title>
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
			<br>Username <input type="text" name="username" pattern=".{3,24}" title="Username can only be 3-24 characters." required><br> <br> Password
			&nbsp;<input type="password" name="password" pattern=".{6,24}"
				title="Must be 6-24 characters long" required><br> <br> Re-enter Password &nbsp;<input
				type="password" name="passwords" pattern=".{6,24}"
				title="Must be 6-24 characters long" required><br> <br> <input type="submit"
				name="register" value="Register"><br> <br>
			
		<?php
if (isset($_SESSION['registerError']))
    echo $_SESSION['registerError'];
?>
		
		</form>
	</div>
</body>
</html>