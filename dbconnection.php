<?php
$hostname="localhost";
$user="root";
$password="";
$database="google_db";
$mysqli=new mysqli($hostname,$user,$password,$database);
if($mysqli->connect_error){
	echo "Fail to connect".$mysqli->connect_error;
}
else{//echo "Connect Successfully";
}
?>