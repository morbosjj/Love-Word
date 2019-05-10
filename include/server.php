<?php
	session_start();
	$firstname = "";
	$lastname = "";
	$username = "";
	$email = "";
	$errors = array();
	$error2 = array();

	$db = mysqli_connect('localhost', 'root','','loveword');

	if(isset($_POST['register'])){
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		if (empty($firstname)) {
			array_push($errors, "Firstname is required");	
		}
		if (empty($lastname)) {
			array_push($errors, "Lastname is required");	
		}
		if (empty($username)) {
			array_push($errors, "Username is required");	
		}
		if (empty($email)) {
			array_push($errors, "Email is required");	
		}
		if (empty($password_1)) {
			array_push($errors, "Password is required");	
		}

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		//Insert into database
		if (count($errors) ==0) {
			$password = md5($password_1);
			$sql = "INSERT INTO user (firstname, lastname, username, email, password) VALUES ('$firstname', '$lastname', '$username', '$email','$password')";
			mysqli_query($db, $sql);
			
		}

	}

	if (isset($_POST['login'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

	if (empty($username)) {
			array_push($error2, "Username is required");	
		}
	if (empty($password)) {
			array_push($error2, "Password is required");	
	}

	if (count($error2) == 0) {
		$password = md5($password);
		$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) == 1) {
		 	$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: home.php');	
		 }else{
		 	array_push($error2, "Wrong username/password incorrect.");
		 }
	}

}



	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header('location: login.php');
	}
?>