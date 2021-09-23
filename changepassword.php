<?php 
include('dbconnection.php');
session_start();
$email=$_SESSION['email'];
if($email==""){
	header('location:Register.php');
}
$sql="SELECT * FROM user email WHERE email='$email'";
$res=$mysqli->query($sql);
$row=$res->fetch_assoc();
if(isset($_POST['submit'])){
	$id=$_POST['id'];
	$oldpassword=$_POST['password'];
	$newpassword=$_POST['newpassword'];
	$confirmpassword=$_POST['confirmpassword'];
	if(($oldpassword!='') && ($newpassword!='') && ($confirmpassword!='')){
		$query="UPDATE user SET password='$newpassword' WHERE id=$id ";
		$result=$mysqli->query($query) or die($mysqli->error);
		if($result){
			echo "<br> Update Succcessfully";
		}
		else{"<br> Operation is Unsuccessfull";}
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
<title>ChangePassword</title>
<style>
form{
border:1px solid #DADCE0;
border-radius:10px;
width:500px;
padding:40px 40px 36px;
margin:0 auto;
}
.image{
text-align:center;
}
</style>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#frm').validate({
		rules:{
			password:{
			required:true,
			minlength:8,
			pwcheck:true
		},
		newpassword:{
			required:true,
			minlength:8,
			pwcheck:true
		},
		confirmpassword:{
			required:true,
			equalTo:"#newpassword"
		}
		},
		messages:{
		password:{required:"Password is required",
					minlength:"Length not less  than 8 character"},
		newpassword:{required:"Password is required",
					minlength:"Length not less  than 8 character"},			
		confirmpassword:{required:"Password confirmation is required",
						equalTo:"password is not matching"}		
	},
		submitHandler:function(form){
			form.submit();
		}
		
	});
});
jQuery.validator.addMethod("pwcheck", function(value,element){return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(value);},"Password is not matching");
</script> 
</head>
<body>
	<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off" method="post" id="frm" enctype="multipart/form-data">
		<h1 style="text-align:center;text-decoration:underline;">ChangePassword </h1>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="image">
					<?php $image=$row['userimage']; ?>
						<img src="upload/<?php echo $image; ?>" alt="userimage">
					</div>
					<div class="username text-center font-weight-bold">
						<?php $username=$row['username']; echo $username; ?>
					</div>
					<div class="form-group">
						<label for="OldPassword">OldPassword</label><br>
						<input type="text" name="password" id="password" class="form-control">
					</div>	
					<div class="form-group">
							<label for="NewPassword">NewPassword</label><br>
							<input type="text" name="newpassword" id="newpassword" class="form-control">
					</div>
					<div class="form-group">
							<label for="ConfirmPassword">ConfirmPassword</label><br>
							<input type="text" name="confirmpassword" id="confirmpassword" class="form-control">
					</div>
					<input type="hidden" name ="id" value="<?php echo $row['id']; ?>">
					<input type="submit" class ="btn btn-info btn-flat" value="Submit" name="submit">
					<a href="#" class="btn btn-info btn-flat">Cancel</a>
				</div>
			</div>
		</div>
	</form>
	
	
</body>
</html>