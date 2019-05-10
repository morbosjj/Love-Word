<?php include('server.php');  ?>
<html>
<head>
	<title>home</title>
</head>
<body>
	<h2>Homepage</h2>

	<div class="content">
		<?php if(isset($_SESSION['success'])): ?>
			<div class="error success">
				<h3>
					<?php 
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<?php if(isset($_SESSION['username'])): ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p><a href="home1.php?logout='1'" style="color: red;">Logout</a></p>
		<?php endif ?>
	</div>
</body>
</html>