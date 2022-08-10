<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: Login_Page.php');
	exit;
}

ob_start();
include("dbconnect.php");
$id=$_REQUEST['id'];
$sql="delete from tbl_add_venues where id=$id";
if ($conn->query($sql) == TRUE) {
    $message = "Record Deleted Successfully.";
}else{
    $message = "Record Not yet deleted";
}
header("Location: delete_venue.php?message=$message");

?>


