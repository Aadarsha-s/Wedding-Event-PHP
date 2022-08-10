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
if($id == 0){
    header("location:edit_venue.php");
}

$result=$conn->query("select * from tbl_add_venues where id = '$id'");
if($result->num_rows > 0){
	while($rs=$result->fetch_assoc()){
	    $title = $rs["name"];
	    $address = $rs["address"]; 
		$contact = $rs["contact"];
		$facilities = $rs["facilities"];
	    $description = $rs["description"];
	    $photo = $rs["photo"];
	}
}else{
		$title = '';
	    $address = '';
		$contact = '';
		$facilities = '';
	    $description = '';
	    $photo = '';
	}

if(isset($_POST["submit"])){
        $title = $_POST["title"];
        $address = $_POST["address"];
		$contact = $_POST["contact"];
		//$facilities = $_POST["facilities"];
		//$cat_value = "";
    //     foreach($category as $value)  
      //      {  
        //       $cat_value[]= $value;  
          //  }
        //$cat_value = implode(",",$facilities);
        $description = htmlspecialchars($_POST["description"],ENT_QUOTES);
           $uploadedphoto=$_FILES["photo"]["name"];

        // Check if the new uploaded photo is empty or not
		if($uploadedphoto==''){
			$newphoto=$photo;
		}else {
			$newphoto=$uploadedphoto;
			//upload photo
			$tpath= "upload/";
			$tpath= $tpath.basename($_FILES["photo"] ["name"]);
			move_uploaded_file($_FILES['photo']['tmp_name'], $tpath);
			@unlink($photo);
		}

        $sql = "update tbl_add_venues set name='$title', address='$address',contact='$contact', description='$description', photo='$newphoto' where id='$id'";
        if($conn->query($sql)== TRUE){
        //echo "<script type= 'text/javascript'>alert('Record updated successfully');</script>";
        //header('location:listarticle.php');
		  $message = "Record updated Successfully.";
		  header("Location: edit_venue.php?message=$message");
        } else {
        echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
        }
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

<title>Edit Venue Page Detail</title>
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
		<a href="#view_booking.php">View Booking</a>
		<a href="add_venue.php">Add Venue</a>
		<a href="home.php">Home</a>
	</div>
<div class="container">	
<form name="add" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" onsubmit="return validate_Form()">
 <input type="hidden" name="id" value="<?php echo $id;?>"><br>
   	<fieldset>
    <!--legend>Please Fill All the field</legend-->
    <p>
        <label for="title">Venue Name:</label>
        <input type="text" name="title" id="title" style="width: 30%" value="<?php echo $title; ?>">
    </p>
    
	<p>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" style="width: 30%" value="<?php echo $address; ?>">
    </p>
	
	
	 <p>
        <label for="contact">Contact number:</label>
        <input type="number" name="contact" id="contact" style="width: 30%" value="<?php echo $contact; ?>">
    </p>

	<p>
        <label for="facilities">Facilities:</label>
        <input type="checkbox" name="facilities[]" id="facilities" value="Live Band">Live Band
		 <input type="checkbox" name="facilities[]" id="facilities" value="Music System" >Music System
		  <input type="checkbox" name="facilities[]" id="facilities" value="Parking" >Parking
		  
	</p>
    <p>
        <label for="description">Time Slot:</label><br>
        <textarea name="description" id="description" rows="8" cols="40"><?php echo $description;?></textarea>
    </p>
    <p>
        <label for="photo">Photo:</label>
        	<input name="photo" type="file" id="photo">
        <br>
        <br>
        <?php
        if($photo !=''){?>
        	<img src="<?php echo 'upload/'.$photo;?>" width="100" height="100">
       <?php
    		}
        ?>
     </p>
  
   <input type="submit" name="submit" class="btn btn-primary" role="button" onclick="clicked(event)" />
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
