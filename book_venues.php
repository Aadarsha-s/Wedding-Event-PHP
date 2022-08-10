<?php 
include("dbconnect.php");


$sql = "select * from tbl_add_venues";
$result=mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel = "stylesheet" href="css/style_1.css">
    <link rel="stylesheet" href="bootstrap_css/bootstrap.min.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<title>Book Venues</title>

</head>
<body>
	<header style="height: 20vh;">
		<div class="nav-area">
			<div class="logo">Venues</div>
			<ul class = "menu-area">
				<li><a href="index.html">Home</a></li>
				<li><a href="view_venues.php">View Venues</a></li>
				<li><a href="book_venues.php">Book Venues</a></li>
				<li><a href="about_us.html">About us</a></li>
				<li><a href="contact_us.html">Contact us</a></li>
			</ul>
		</div>
	</header>

	<div class="container">
	  <center><h2>Customer Booking Details:</h2></center><br>
		<form name="add" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" onsubmit="return validate_Form()">
 			<div class="form-group">
				<label for="name">Your Name:</label>
				<input type="text" class="form-control" id="name" name="name" required>
			</div>
			<div class="form-group">
				<label for="contact">Contact Number:</label>
				<input type="number" class="form-control" id="contact" name="contact" required>
			</div>
			<div class="form-group">
			<label for="selectvenues">Select Venues:</label>
				<select name="select_venue" id="select_venue">
					<option>Select venue:</option>
				<?php 
					while($rows = mysqli_fetch_assoc($result)){
				?>
					<option value="<?php echo $rows['name'];?>"> <?php echo $rows['name'];?></option>
				<?php
					}
				?>
				</select>
			</div>
			<div class="form-group">
				<label for="shift">Shift:</label>
				<input type="text" class="form-control" id="shift" name="shift" required>
			</div>
			<div class="form-group">
				<label for="submit"></label>
				<input type="submit" name="submit" value="Submit" class="btn btn-primary" role="button">
				<input type="reset" name="cancel" value="Cancel" class="btn btn-primary" role="button">
			</div>
		
		</form>
	</div>

	<footer style="position:fixed; bottom:0px;">
	<div class = "footer-bottom">
		<p>copyright &copy;2021 codeVenues. designed by <span>Aadarsha Shakya</span></p>
	</div>
	</footer>
	<!--div class="content">
		<h2>Home Page</h2>
		<p>Welcome back, <?=$_SESSION['name']?>!</p>
	</div-->
</body>
</html>
<?php
ob_start();
include("dbconnect.php");
if(isset($_POST["submit"])){
        $c_name = $_POST["name"];
		$c_contact = $_POST["contact"];
		$c_venue_select = $_POST["select_venue"];
		$c_shift = $_POST["shift"];
	//	$cat_value = "";
        // foreach($category as $value)  
        //    {  
        //       $cat_value[]= $value;  
        //    }
       // $cat_value = implode(",",$c_venue_select);
		 
        $sql = "INSERT INTO tbl_customer_book(c_name, c_contact,c_venue_select,c_shift) VALUES ('$c_name','$c_contact','$c_venue_select','$c_shift')";
        if($conn->query($sql)== TRUE){
        echo "<script type= 'text/javascript'>alert('Booking successfully.');</script>";
        //header('location:listarticle.php');
        } else {
        echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
        }
		//header('Location: add_venue.php');
        echo "<script>
                   window.location = 'view_venues.php';
          </script>";
}

?>

<script> 
function validate_Form()								 
{ 
	var name = document.add.name;		
	var address = document.add.address;
	var shift = document.add.shift;
	
	//for title
	if(name.value == ""){ 	
		alert("Your Name must be filled."); 
		name.focus(); 
		return false;
	}else if(name.value.length <=3){ 
		alert("Your Name must have atleast 4 characters."); 
		name.focus(); 
		return false;  
	}else{
		var letters = /^[A-Za-z ]*$/;    
		if(!name.value.match(letters)){
			alert('Your Name must have alphabet characters and white space only.');
			name.focus(); 
			return false;
		}
	}
	

	//for phone
	if (phone.value == "")						 
	{ 
		window.alert("Contact number must be filled."); 
		phone.focus(); 
		return false; 
	}else{
		var phona = /^\d{8,10}$/;
		if(!phone.value.match(phona)){
			alert('Contact number must be 8 or 10 digit number.');
			phone.focus(); 
			return false;
		}
	}
	
	//for shift
	if(shift.value == ""){ 	
		alert("Your shift must be filled."); 
		shift.focus(); 
		return false;
	}else if(shift.value.length <=3){ 
		alert("Your shift must have atleast 4 characters."); 
		name.focus(); 
		return false;  
	}else{
		var letters = /^[A-Za-z0-9 ]*$/;    
		if(!shift.value.match(letters)){
			alert('Your shift must have alphabet characters and white space only.');
			name.focus(); 
			return false;
		}
	}
	return true; 
}	
</script>

