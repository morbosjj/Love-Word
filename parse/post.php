<script src="jquery.js"></script>
<script>
	$(document).ready(function(){
		$("#success").fadeIn(500);
		$("#success").fadeOut(700);
	});
</script>
<style>
	#success {
		background-color: rgb(25,118,210);
		width: 20%;
		color: white;
		font-weight: bold;
		position: absolute;
		top: 10;
		right: -300;
		border-radius: 20px;
		text-align: center;
		display: none;
	}
</style>
<?php include ('../include/server.php'); ?>
<?php 
	$db = mysqli_connect('localhost', 'root','','loveword');
	$postdate = date('m-d-y h:i:s A');
	if (isset($_POST['post'])) {
		$post = strip_tags(mysqli_real_escape_string($db, $_POST['post']));
		$user = $_SESSION['username'];

	mysqli_query($db, "INSERT INTO posts(username, body, datepost) VALUES('$user','$post','$postdate')");
		echo "<div id='success'>Posted</div>";
	}
?>
