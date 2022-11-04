<?php 
require_once '../controllerUserData.php';

 
error_reporting(0);
include('database.inc');
$msg ="";


if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($con,$_POST['name']);
    $mobile = mysqli_real_escape_string($con,$_POST['mobile']);
    $checkbox1=$_POST['wastetype'];  
    $chk="";  
      foreach($checkbox1 as $chk1)  
             {  
                 $chk .= $chk1.",";  
             } 

    $email = mysqli_real_escape_string($con,$_POST['email']);
	$status = mysqli_real_escape_string($con,$_POST['status']);
    $location = mysqli_real_escape_string($con,$_POST['location']);    
    $locationdescription = mysqli_real_escape_string($con,$_POST['locationdescription']);
	$date = $_POST['date'];
	
	$file = $_FILES['file']['name'];
	$target_dir = "othersFiles/upload/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
  
	// Select file type
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
	// Valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif","tif", "tiff");
  
	//validate file size 
  //   $filesize = $_FILES["file"]["size"] < 5 * 1024 ;
  
	// Check extension
	if( in_array($imageFileType,$extensions_arr) ){
   
	
	   // Upload file
	   move_uploaded_file($image = $_FILES['file']['tmp_name'],$target_dir.$file);
  
	}

		$sql = "insert into garbageinfo(name,mobile,email,wastetype,location,locationdescription,file,date,status)values('$name','$mobile','$email','$chk','$location','$locationdescription','$file','$date','$status')";
		
    	if(mysqli_query($con,$sql)){
			$msg = '<div class = "alert alert-success"><span class="fa fa-check"> "Compain Registered Successfully!"</span><a href="welcome.php"> view Complain </a></div>';
		
		}else {
			$msg= '<div class = "alert alert-warning"><span class="fa fa-times"> Failed to Registered !"</span></div>';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet"type="text/css"href="style.css">
    <title>Complain</title>
  
</head>
<body>
<a style="float:right; margin-right:10px;z-index:5;display:block;text-decoration:none;" href="#" onclick="history.back()"><h5>X</h5></a>
   <?php 
   $error ='';   
   ?>
   <form method="post" action="complain.php" enctype="multipart/form-data">
   <div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="contact-info">
				<img src="images.jpg" alt="image"/>
				<h2>Register Your Complain</h2>
				<h4></h4>
			</div>
		</div>
		<div class="col-md-9">
			<div class="contact-form">
				<div class="form-group">
				<div id="error"></div>
              <span style="color:red"><?php echo "<b>$msg</b>"?></span>
				  <label class="control-label col-sm-2" for="fname"> Name:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name" required>
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="lname">Mobile:</label>
				  <div class="col-sm-10">          
					<input type="number" class="form-control" id="mobile" placeholder="Enter Your Mobile Number" name="mobile"required min ="80000000" max="100000000000">
				  </div>
				</div>
				<div class="form-group">
				  <!-- <label class="control-label col-sm-2" for="email">Email:</label>
				  <div class="col-sm-10"> -->
					<input type="hidden" class="form-control" id="email" placeholder="Enter Your email" name="email" value="<?php echo   $_SESSION['email'];?>"> 
				  <!-- </div> -->
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="option">Category:</label>
					<div class="col-sm-10">          
					    <input type="checkbox" name="wastetype[]" value="Tv"> Tv
                        <input type="checkbox" name="wastetype[]" value="Radio"> Radio
                        <input type="checkbox" name="wastetype[]" value="mobile_phones"> mobile phones
                        <input type="checkbox" name="wastetype[]" value="mixed"id="mycheck" checked> All
					</div>
				  </div>
				  <div class="form-group">
					<label class="control-label col-sm-2" for="lname">Location:</label>
					<div class="col-sm-10">          
					   <select class="form-control" id="location" name="location"required>
						   <option class="form-control" >Takoradi</option>
						   <option class="form-control" >sekondi</option>
					   </select>
					</div>
				  </div>
				<div class="form-group">
				  
				  <div class="col-sm-10">
					<textarea class="form-control" rows="5" id="locationdescription" placeholder="Enter Location details..." name="locationdescription" required></textarea>
				  </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="lname">Pictures:</label>
					<div class="col-sm-10">          
					  <input type="file" class="form-control" id="file" name="file"required accept="image/*" capture="camera">
					</div>
				  </div>
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
				   <input type='hidden' class="form-control" id="date" name="status" value="Pending">
				    <input type="hidden" class="form-control" id="date" name="date" value="<?php $timezone = date_default_timezone_set("Asia/Kathmandu");
                                                                                             echo  date("g:ia ,\n l jS F Y");?>">
					<button type="submit" class="btn btn-default" name="submit" >Register</button>
					<br><br>
					
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>
   </form>
</div>
<script type="text/javascript"  src="formValidation.js"></script>
<script>



</script>
</body>

</html>