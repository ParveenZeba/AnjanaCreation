<?php
session_start();
include('dbconnection.php');
if(isset($_POST['submitBtn'])){
	$email=$_POST['email'];
	$password=$_POST['password'];
	if(!empty($email) && !empty($password)){
		$query="SELECT email,password FROM user WHERE email='$email' AND password='$password' ";
		$result=$mysqli->query($query);
		$count=$result->num_rows;
		if($count==1){
			$_SESSION['email']=$email;
			header('location:user.php');
		} else{
			echo "You are not registered user";
		}
		
	}
	else{
		echo "Please fill Email and Password";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>SignIn</title>
<style>
form{
border:1px solid #DADCE0;
border-radius:10px;
width:750px;
padding:48px 40px 36px;
margin:0 auto;
}
</style>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
	<body>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" autocomplete="off">
		<h1 style="text-align:center;text-decoration:underline;">SIGNIN</h1>
		<div class="form-group">
			<label for="Email">EMAIL:</label>
			<input type="email" name="email" value="" placeholder="Email" class="form-control">
		</div>
		<div class="form-group">
			<label for="Password">PASSWORD:</label>
			<input type="password" name="password" value="" placeholder="Password" class="form-control">
		</div>
		<input type="submit" class="btn btn-info btn-flat" value="Submit" name="submitBtn">
		
	</form>	
	</body>
</html>