<?php
require_once('connect.php');
$id = $_GET['id'];
$DelSql = "DELETE  FROM `crud` WHERE id='$id'";
$res = mysqli_query($connection, $DelSql);
$r = mysqli_fetch_assoc($res);
if(isset($_POST) & !empty($_POST)){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$age = $_POST['age'];
	$username =$_POST['username'];
	$password = $_POST['password'];

	$DelSql = "DELETE `crud` SET first_name='$fname', last_name='$lname', gender='$gender', age='$age', email_id='$email',username='$username',password='$password' WHERE id=$id";
	$res = mysqli_query($connection, $DelSql);

if($res){
	header('location: view.php');
}else{
	echo "Failed to delete";
}
}
?>