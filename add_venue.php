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

if(isset($_POST["submit"])){
        $title = $_POST["title"];
		$address = $_POST["address"];
		$contact = $_POST["contact"];
		$facilities = $_POST["facilities"];
		$cat_value = "";
        // foreach($category as $value)  
        //    {  
        //       $cat_value[]= $value;  
        //    }
        $cat_value = implode(",",$facilities);
		$description = $_POST["description"];
        $tpath= "upload/";
        $tpath= $tpath.basename($_FILES["photo"] ["name"]);
        move_uploaded_file($_FILES['photo']['tmp_name'], $tpath);
        $uploadedphoto=$_FILES["photo"]["name"];
        if($uploadedphoto==''){
            $uploadedphoto='';
        }
        
        $sql = "INSERT INTO tbl_add_venues(name, address,contact,facilities, description,photo) VALUES ('$title','$address','$contact','$cat_value','$description','$uploadedphoto')";
        if($conn->query($sql)== TRUE){
       // echo "<script type= 'text/javascript'>alert('New record created successfully');</script>";
          $message = "New Record Inserted Successfully.";
		  header("Location: list_venue.php?message=$message");
		//header('location:listarticle.php');
        } else {
        echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
        }
		//header('Location: add_venue.php');
        echo "<script>
                   window.location = 'edit_venue.php';
          </script>";
}
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Add Venue Page</title>
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
<p><h2>Add Venues</h2></p>
<form name="add" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" onsubmit="return validate_Form()">
    <fieldset>
    <!--legend>Please Fill All the field</legend-->
    <p>
        <label for="title">Venues Name:</label>
        <input type="text" name="title" id="title" style="width: 30%" required>
    </p>
	 <p>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" style="width: 30%" required>
    </p>
	
	 <p>
        <label for="contact">Contact number:</label>
        <input type="number" name="contact" id="contact" style="width: 30%" required>
    </p>
	 <p>
        <label for="facilities">Facilities:</label>
        <input type="checkbox" name="facilities[]" id="facilities" value="Live Band" >Live Band
		 <input type="checkbox" name="facilities[]" id="facilities" value="Music System">Music System
		  <input type="checkbox" name="facilities[]" id="facilities" value="Parking">Parking
		  
	</p>
	
	
	 <p>
        <label for="description">Time Slot:</label><br>
        <textarea name="description" id="description" rows="8" cols="40" required></textarea>
    </p>
    <p>
        <label for="photo">Photo:</label>
        <input name="photo" type="file" id="photo" required>
      </p>

    <input type="submit" name="submit" value="Submit" class="btn btn-primary" role="button">

	</fieldset>
</form>

	<!--div class="content">
		<h2>Home Page</h2>
		<p>Welcome back, <?=$_SESSION['name']?>!</p>
	</div-->
    </div>
</body>
</html>
<script> 
function validate_Form()								 
{ 
	var title = document.add.title;		
	var address = document.add.address;
	var phone = document.add.contact;
	
	//for title
	if(title.value == ""){ 	
		alert("Venue name must be filled."); 
		title.focus(); 
		return false;
	}else if(title.value.length <=3){ 
		alert("Venue name must have atleast 4 characters."); 
		title.focus(); 
		return false;  
	}else{
		var letters = /^[A-Za-z ]*$/;    
		if(!title.value.match(letters)){
			alert('Venue Name must have alphabet characters and white space only.');
			title.focus(); 
			return false;
		}
	}
	
	//for address
	if (address.value == "")							 
	{
		alert("Address must be filled."); 
		address.focus(); 
		return false; 
	}else{
		var letters = /^[A-Za-z0-9'\.\-\s\,\#]*$/;
		if(!address.value.match(letters)){
			alert('Address format is invalid');
			address.focus(); 
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
	
	return true; 
}	
</script>

