<?php
session_start();
$conn = mysqli_connect("localhost","root","","admin_login");
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
	// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['uname'], $_POST['psw']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['uname']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	
if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['psw'], $password)) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['uname'];
		$_SESSION['id'] = $id;
		//echo 'Welcome ' . $_SESSION['name'] . '!';
		header('Location: home.php');
	} else {
		// Incorrect password
		#echo 'Incorrect username and/or password!';
		 echo "<script>
				alert('Incorrect username and/or password!');
                        window.location = 'Login_Page.php';
              </script>";
	}
} else {
	// Incorrect username
	#echo 'Incorrect username and/or password!';
	 echo "<script>
				alert('Incorrect username and/or password!');
                        window.location = 'Login_Page.php';
              </script>";
}

	$stmt->close();
}
?>

