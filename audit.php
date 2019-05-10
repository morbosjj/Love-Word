<?php include('server.php'); ?>	
<?php 
	if (isset($_POST['login'])) {
		$_SESSION['username'] = $username;
		$insertaud = mysqli_query("INSERT INTO audit(username, logintime)
			VALUES('$username');");
	}
?>