	<?php
	include('../include/server.php');
	$username = $_SESSION['username'];
	$query = mysqli_query($db, "SELECT body, username FROM posts WHERE username = '$username' ORDER BY id_user DESC");
		while ($row = mysqli_fetch_array($query)) {
			$body = $row['body'];
			$username = $row['username'];
	?>
	<br>
	<br>
	<br>
	<div class='post'>
		<div id="post-img">
		<?php
		    $db = mysqli_connect("localhost","root","","loveword");
		    $sql = "SELECT image FROM images WHERE username = '$username' ";
		          $result = mysqli_query($db, $sql); 
		          while ($row = mysqli_fetch_array($result)) { ?>
		    <?php echo "<img name='image' src='images/".$row['image']."'>"; ?>
		    <?php   }
		?>
		<?php 
				$username = $_SESSION['username'];
				$get_user = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
				$get = mysqli_fetch_array($get_user);
					$firstname = $get['firstname'];
					$lastname = $get['lastname'];
			?>
		  
		</div>
		<div id="author"><p><?php echo $firstname; ?> <?php echo $lastname; ?></p></div>
		<div id="body-post"><p><?php echo $body; ?></p></div>
	</div>
	<?php 
		}
	?>