<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: Login_Page.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Home Page</title>
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #255B5C;
}

.topnav a {
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
	<div class="topnav">
		<a href="logout.php">Logout</a>
		<a href="delete_venue.php">Delete Venue</a>
		<a href="edit_venue.php">Edit Venue</a>
		<a href="list_venue.php">List Venue</a>
		<a href="view_booking.php">View Booking</a>
		<a href="add_venue.php">Add Venue</a>
		<a href="home.php">Home</a>
	</div>
	
	<!--div class="content">
		<h2>Home Page</h2>
		<p>Welcome back, <?=$_SESSION['name']?>!</p>
	</div-->
</body>
</html>

