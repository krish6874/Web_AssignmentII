<?php
	session_start();
	require_once ('connect.php');
if(isset($_POST) & !empty($_POST)){
	$username = $_POST['username'];
	$password = $_POST['password'];

	mysqli_connect('localhost', 'root','') or die(mysqli_error()); //Connect to server
	mysqli_select_db($connection, 'project') or die('Cannot connect to database'); //Connect to database
	$query = mysqli_query($connection, "SELECT * from crud WHERE username = '$username' "); //Query the users table if there are matching rows equal to $username
	
	$exists = mysqli_num_rows($query); //Checks if username exists
	$table_users = "";
	$table_password = "";
	if($exists > 0) //IF there are no returning rows or no existing username
	{
		while($row = mysqli_fetch_assoc($query)) //display all rows from query
		{
			$table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
			$table_password = $row['password']; // the first password row is passed on to $table_users, and so on until the query is finished
		}
		if(($username == $table_users) && ($password == $table_password)) // checks if there are any matching fields
		{
				if($password == $table_password)
				{
					$_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
					header("location: view.php"); // redirects the user to the authenticated view page
				}
				
		}
		else
		{
			Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
			Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
		}
	}
	else
	{
		Print '<script>alert("Incorrect Username!");</script>'; //Prompts the user
		Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
	}
}

?>