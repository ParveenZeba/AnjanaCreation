<?php 
session_start();
include("dbconnection.php");
$email=$_SESSION['email'];
//echo $email;
if($email==""){
header('location:Register.php');}
	$sql="SELECT * FROM user WHERE email='$email'";
	$res=$mysqli->query($sql);
	$row=$res->fetch_assoc();
	//print_r($row);

?>
<!DOCTYPE html>
<html>
<head>
<title>Update Account</title>
<style>
form{
border:1px solid #DADCE0;
border-radius:10px;
width:900px;
padding:40px 40px 36px;
margin:0 auto;
}
.error{color:red;}
</style>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.validate.min.js"type="text/javascript"></script>
<script type="text/javascript"> 
$(document).ready(function(){
$("#frm").validate({
	rules:{
		username:{
			required:true,
			namecheck:true
	},
		dob:{required:true},
		phone:{required:true,
			minlength:10	
		},
		address:{required:true
		},
		email:{required:true,
				email:true
		}
		
	},
	messages:{
		username:{
		required:"Name must be required",
		namecheck:"Only Letters and White Spaces are Allowed"
		},
		dob:{required:"Date of Birth must be filled"},
		phone:{required:"PhoneNo. is required ",
				minlength:"Number length must be 10 digit",
		},
		address:{required:"Address is required"},
		email:{required:"Email is required",
				email:"Please enter a valid email address"
		}	
	},
		submitHandler:function(form){
			form.submit();
		}
});			
});
jQuery.validator.addMethod("namecheck",function(value,element){return this.optional(element)||/^[a-zA-Z ]*$/.test(value);},"Only letters and white space allowed");
</script>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" autocomplete="off" id="frm" enctype="multipart/form-data">
	<h1 style="text-align:center;text-decoration:underline;">Update Account</h1>
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<div class="form-group">
					<div class="image">
					<?php 
						$image=$row['userimage'];
						if($image==""){
					?>
						<img src="images/profilephoto.png" class="rounded-circle" alt="user image" width="304" height="236"><?php } else {  ?>
						<img src="upload/<?php echo $image;?>" alt="image" class="imageupload">
						<?php } ?>
						<input type="file" name="myfile" id="myfile" class="myfile" accept="image/*">
					</div>
					</div>
					<div class="gender col-12">
					<?php 
		
					echo $gender=$row['gender'];
		
					?>
			Gender<input type="radio" name="gender" <?php if($gender=='male'){ echo 'checked';}	else
			{echo '';} ?> value="male" id="gender">Male
			<input type="radio" name="gender" <?php if($gender=='female'){ echo 'checked';}	else
				{echo '';} ?> value="female" id="gender">Female
		</div>
					<!--<div class="form-group">
					<div class="form-check-inline">
						Gender<label class="form-check-label" for="radio1">
						<?php echo $row['gender'];?>
						<input type="radio" name="gender" <?php if($gender=='male'){ echo 'checked';}	else
{echo '';} ?> value="male"  class="form-check-input" id="radio1">Male
						</label>
					</div>
					<div class="form-check-inline">
						<label class="form-check-label" for="radio2">
						<input type="radio" name="gender" <?php if($gender=='female'){echo 'checked';}else{echo'';}?> value="female"  class="form-check-input" id="radio2">Female
						</label>
					</div>
					</div>-->
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label for="username">USERNAME:</label>
						<input type="text" name="username" value="<?php echo $row['username'];?>" placeholder="Name" class="form-control" id="username">
					</div>
					<div class="form-group">
						<label for="DOB">DOB:</label>
						<input type="date" name="dob" value="<?php echo $row['dob'];?>" placeholder="Birthdate" class="form-control" id="dob">
					</div>
					<div class="form-group">
						<label for="Phone">PHONE:</label>
						<input type="tel" name="phone" value="<?php echo $row['phone'];?>" placeholder="PhoneNo." class="form-control" id="phone">
					</div>
					<div class="form-group">
						<label for="Address">ADDRESS:</label>
						<input type="text" name="address" value="<?php echo $row['address'];?>" placeholder="Address" class="form-control" id="address">
					</div>
					<div class="form-group">
						<label for="Email">EMAIL:</label>
						<input type="email" name="email" value="<?php echo $row['email'];?>" placeholder="Email" class="form-control" id="email">
					</div>
					
					<input type="hidden" name="id" value="<?php echo $row['id'];?>">
					<input type="submit" class="btn btn-info btn-flat" value="Update" name="submit">
					<a href="#" class="btn btn-info btn-flat">Cancel</a>
				</div>	
			</div>	
		</div>		
	</form>
	<div class="row">
		<div class="col-md-12">
			<a href="changepassword.php" title="newpassword" class="changepsw">ChangePassword</a>
			<a href="logout.php" title="logout" class="logout">Logout</a>
		</div>
<?php
if(isset($_POST['submit'])){
	$id=$_POST['id'];
	$gender=$_POST['gender'];
	$username=$_POST['username'];
	$dob=$_POST['dob'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$email=$_POST['email'];
	$target_dir="upload/";
	$myfile=date('d-m-Y-h-i-sa').basename($_FILES['myfile']['name']);
	$target_file=$target_dir.$myfile;
	$uploadok=1;
	echo"<br>";
	$imagefiletype=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$temp_name=$_FILES['myfile']['tmp_name'];
	$check=getimagesize($temp_name);
	echo"<br>";
	//check if image is actual image or fake image 
	if($check!==false){
		//echo "File is an image".$check['mime'];
		$uploadok=1;
		//check The file size
		if($_FILES['myfile']['size']>500000){
			echo "File size is too large<br>";
			$uploadok=0;
		}
		else{
			if($imagefiletype!='jpg' && $imagefiletype!='png' && $imagefiletype!='gif' && $imagefiletype!='jpeg'){
				echo "Sorry only jpeg, jpg, png or gif  image are allowed "; 
			}
			else{
				if(move_uploaded_file($temp_name,$target_file)){
					//echo "the file has been uploaded".htmlspecialchars($myfile);
				if(($username!="") && ($dob!="") && ($phone!="") && ($address!="") && ($email!="") && ($gender!="")){
					$query="UPDATE user SET username='$username',dob='$dob',phone='$phone',email='$email',address='$address',gender='$gender', userimage='$myfile' WHERE id=$id";
					$result=$mysqli->query($query) or die($mysqli->error);
					if($result){
						echo "<br> Update Successfully";
					}
					else{"Some Error Occurred";}
				}	
				}
				else{echo "There is an error in loading the file ";}
			}
		}
	}
	else{echo "file is not an image";
	$uploadok=0;
	}
}
?>	
</body>
</html>