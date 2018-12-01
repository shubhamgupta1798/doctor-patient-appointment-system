<?php
	session_start();
	echo "<div style='margin-top:200px;'></div>";
	echo "<h1 style='color:#FF0000;text-align: center;'>Logged out successfully !</h1>";
//	echo "<a href='user.php' style='text-align: center;display:block;font-size: 162.5%;'>Login Again using Login Page</a>";
	session_destroy();
	header('Location:user.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log Out</title>
</head>
<body>
</body>
</html>
