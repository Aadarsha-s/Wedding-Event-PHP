<html>
	<head>
		<title>System - Log In or Sign Up</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>
<body>
	<div id="container">
	<form method = "post" action="authenticate.php">
	<img src="images/login.jpg" width="100" height="100">
	<div>
	<p><input type="text" placeholder="Username" size="25" maxlength="15" name="uname" required></p>
	</div>
	<div>
	<p><input type="password" placeholder="Password" size="25" maxlength="15" name="psw" required></p>
	</div>
	<button class="login" type="submit" name="submit">Log In</button><br><br>
	<!--a href="#">Forget password?</a-->
	</div>
</body>
</html>
