<?php
include("dbconnect.php");
$sql = "select * from tbl_add_venues order by id DESC";
$result=mysqli_query($conn,$sql);

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
	<link rel = "stylesheet" href="css/style_1.css">
	<title>View venues</title>
	<style>
	*{
		box-sizing: border-box;
	}
	.contain{
		max-width: 1200px;
		margin: auto;
		overflow: auto;	
		overflow-x:hidden;
	}
	
	.gallery{
		margin:5px;
		float:left;
		display: grid;
	    grid-template-columns: repeat(2, 1fr);
		grid-column-gap: 0px;
		grid-row-gap: 100px;
		width:100%;
		
	}
	.gallery img{
		width: 80%;
		height:280px;
	}
	.desc{
		padding:0;
		text-align:center;
	
	}
	</style>
</head>
<body>
	<header style="height: 10vh;">
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
	
	<center><h2>View Venues</h2></center>
	<div class="contain">
	<div class="gallery">
	
		<?php 
		while($rows = mysqli_fetch_assoc($result)){
				
		?>
	
		
			<img src="<?php echo 'upload/'. $rows['photo'];?>">
				<div class="desc">
		<table class="table table-bordered">
		<tr>
			<th colspan="2" style="text-align: center;">Details</th>
		</tr>
		<tr>
			<td>Name</td>
			<td style="color:red;"><?php echo $rows['name'];?></td>
		</tr>
		<tr>
			<td>Address</td>
			<td><?php echo $rows['address'];?></td>
		</tr>
		<tr>
			<td>Contact no.</td>
			<td><?php echo $rows['contact'];?></td>
		</tr>
		<tr>
			<td>Facilities</td>
			<td><?php echo $rows['facilities'];?></td>
		</tr>
		<tr>
			<td>Time Slot</td>
			<td><?php echo $rows['description'];?></td>
		</tr>
		</table>
		<a href="book_venues.php" class="btn btn-primary" role="button">Book Now</a>
		</div>
		
		<?php
		}
		?>
	
	</div>
	</div>
	
	<footer>
	<div class = "footer-bottom">
		<p>copyright &copy;2021 codeVenues. designed by <span>Aadarsha Shakya</span></p>
	</div>
	</footer>
	
</body>
</html>


<!--script type="text/javascript">
$(document).ready(function() {
    // $("#event_option").attr('disabled', true);
    // $("#country").hide();
    $("#venue_option").change(function() {
        var venue_id = $(this).val();
        $.ajax({
            url: "view_venues_detail.php",
            type: "post",
            data: "venue_id" + venue_id,
            success: function(result) {
                // $("#country").show();
                // $("#hotel_option").attr('disabled', false);
                $("#event_option").html(result);
            },
            error: function() {
                alert("Error");
            }
        });
    });
});
</script>