<?php 
include('dbconnection.php');
function checkfield($val){
	$val=htmlspecialchars($val);
	$val=trim($val);
	$val=stripslashes($val);
	return $val;
}
if(isset($_POST['submit'])){
$username=$_POST['username'];
$dob=$_POST['dob'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$email=$_POST['email'];
$password=$_POST['password'];
$confirmpassword=$_POST['cpassword'];
$count=0;
if(($username!="") && ($dob!="") && ($phone!="") && ($address!="") && ($email!="") && ($password!="") && ($confirmpassword!="")){
	if(!empty($_POST['username'])){
		$username=checkfield($_POST['username']);
		if(preg_match("/^[a-zA-Z-' ]*$/",$username)){
			$count=$count+1;
		}
		else{
			echo"Only Letters Character And White Spaces Are Allowed ";
		}
		}
		if(!empty($_POST['dob'])){
				$dob=checkfield($_POST['dob']);
			}
		if(!empty($_POST['phone'])){
				$phone=checkfield($_POST['phone']);
		}
		if(!empty($_POST['address'])){
				$address=checkfield($_POST['address']);
		}
		if(!empty($_POST['email'])){
			$email=$_POST['email'];
			if(filter_var($email,FILTER_VALIDATE_EMAIL)){
				$count=$count+1;
			}
		}
		else{
			echo "Invalid Email";
		}
		if(!empty($_POST['password'])){
			if(strlen($password)<=8)
			{$count=$count+1;}
		}
		else{echo "Password length must be according to format ";
		}
		if(!empty($_POST['cpassword'])){
			if($password==$confirmpassword){
				$count=$count+1;}
			else{echo "password doesn't match";}
			
		}
		if($count==4){
			$query="SELECT email,phone FROM user WHERE email='$email'OR phone='$phone'";	
			$res=$mysqli->query($query);
			 $res->num_rows;
			if($res->num_rows>0){
				echo "Sorry record already exist";
			}
			else{
				$result="INSERT INTO user(username,dob,phone,email,address,password) VALUES ('$username','$dob','$phone','$email','$address','$password')";
				$sql=$mysqli->query($result);
				if($sql===TRUE){
					echo "Record Inserted Successfully";
				}
			else{"Process Failed".$mysqli->error;}
			}
		}
}
else
	{
		echo "Enteries not filled properly";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Create Account</title>
<style>

form{
border:1px solid #DADCE0;
border-radius:10px;
width:750px;
padding:48px 40px 36px;
margin:0 auto;
}
.error{color:red;}

</style>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"type="text/javascript"></script>
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
		},
		password:{
			required:true,
			minlength:8,
			pwcheck:true
		},
		cpassword:{
			required:true,
			equalTo:"#password"
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
		},
		password:{required:"Password is required",
				minlength:"Length not less  than 8 character"},
		cpassword:{required:"Password confirmation is required",
					equalTo:"password is not matching"}		
	},
		submitHandler:function(form){
			form.submit();
		}
});			
});
jQuery.validator.addMethod("namecheck",function(value,element){return this.optional(element)||/^[a-zA-Z ]*$/.test(value);},"Only letters and white space allowed");
jQuery.validator.addMethod("pwcheck", function(value,element){return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(value);},"Password is not matching");

</script>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" autocomplete="off" id="frm">
	<h1 style="text-align:center;text-decoration:underline;">Register Yourself</h1>
		<div class="form-group">
			<label for="username">USERNAME:</label>
			<input type="text" name="username" value="" placeholder="Name" class="form-control" id="username">
		</div>
		<div class="form-group">
			<label for="DOB">DOB:</label>
			<input type="date" name="dob" value="" placeholder="Birthdate" class="form-control" id="dob">
		</div>
		<div class="form-group">
			<label for="Phone">PHONE:</label>
			<input type="tel" name="phone" value="" placeholder="PhoneNo." class="form-control" id="phone">
		</div>
		<div class="form-group">
			<label for="Address">ADDRESS:</label>
			<input type="text" name="address" value="" placeholder="Address" class="form-control" id="address">
		</div>
		<div class="form-group">
			<label for="Email">EMAIL:</label>
			<input type="email" name="email" value="" placeholder="Email" class="form-control" id="email">
		</div>
		<div class="form-group">
			<label for="Password">PASSWORD:</label>
			<input type="password" name="password" value="" placeholder="Password" class="form-control" id="password">
		</div>
		<div class="form-group">
			<label for="ConfirmPassword">CONFIRMPASSWORD:</label>
			<input type="password" name="cpassword" value="" placeholder="ConfirmPassword" class="form-control" id="cpassword">
		</div>
		<input type="submit" class="btn btn-info btn-flat" value="Submit" name="submit">
		<a href="SignIn.php" class="col-6" title="login">Sign In Instead</a>
	</form>

</body>
</html>