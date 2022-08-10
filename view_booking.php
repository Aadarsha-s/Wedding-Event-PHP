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
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="bootstrap_css/bootstrap.min.css">
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<title>View User Booking</title>
<style>
body {
	text-align: center;
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
<div class="container">
<h3> List of All Customer</h3>
<?php
$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : ''; 
if($message != ''){
	echo  '<p style="color:red;">'.$message.'</p>';
}	

$sql="select * from tbl_customer_book Order by c_id DESC";
$result = $conn->query($sql);
if($result->num_rows <= 0){
	echo "Data not found !";
}else{

?>	


<table align="center" class="table table-bordered">
<tr>
	
		<th>SN</th>
		<th>Name</th>
		<th>Contact Number</th>
		<th>Venue Selected</th>
		<th>Shift</th>
		<th>Action</th>
	</tr>
<?php
$i=1;
	 while($rows = $result->fetch_assoc()){
	 	
?>


	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $rows['c_name'];?></td>
		<td><?php echo $rows['c_contact'];?></td>
		<td><?php echo $rows['c_venue_select'];?></td>
		<td><?php echo $rows['c_shift'];?></td>
		<td>
		<a href="delete_view_booking_detail.php?id=<?php echo $rows['c_id']; ?>" onClick="return confirm_delete()" class="btn btn-danger" role="button">Delete</a>
		</td>
	</tr>


<?php	
	$i++;
	 }
?>
	 </table>
<?php
	}
?>    	
</div>
</body>
</html>


<script language="javascript">
	function confirm_delete(){
		var $output = confirm("Are you sure you want to delete this record?");
		return $output;
}
</script>















