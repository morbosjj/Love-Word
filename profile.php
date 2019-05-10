<?php include('server.php');  
  $username = $_SESSION['username'];
  if (empty($_SESSION['username'])) {
    header('location: login.php');
  }

  $msg = "";

	if (isset($_POST['upload'])) {
		$target = "images/".basename($_FILES['image']['name']);

		$db = mysqli_connect("localhost","root","","loveword");

		$image = $_FILES['image']['name'];

		$sql = "INSERT INTO images (username, image) VALUES('$username','$image')";
	 	mysqli_query($db, $sql);

		if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
			$msg = "Image uploaded successfully";
		}else{
			$msg = "There was a problem uploading image.";
		}
	}


?>
<?php 
	$usertbl = "SELECT * FROM user";
	$usertblres = mysqli_query($db, $usertbl);	
	if ($row = mysqli_num_rows($usertblres) != 1)  {
		header("refresh: 2; url= login.php");
	}
?>
<html>
<head>
	<title>Profile</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-profile.css">
	<script src="jquery.js"></script>
</head>
<style>
	#icon-home {
		width: 35px;
		position: relative;
		top: 10;
		right: 5;
	}
	#icon-profile {
		width: 35px;
		position: relative;
		top: 10;
		right: 5;
	}
	header nav a:hover {
	background: white;
	color: #2F4F4F;
	padding: 10px;
	}

</style>
<body>
	<header>
		<nav>
			<a href="profile.php"><img id="icon-profile" src="img/icons/profile.png"><?php echo $_SESSION['username']; ?></a>
			<a href="home.php"><img id="icon-home" src="img/icons/home1.png">Home</a>
		</nav>

		<section class="profile-wrapper">
			<div class="profile-section">
			<?php
					$db = mysqli_connect("localhost","root","","loveword");
					$sql = "SELECT image FROM images WHERE username = '$username' ";
					$result = mysqli_query($db, $sql); 
					while ($row = mysqli_fetch_array($result)) { ?>
				<?php		echo" <img name='image' src='images/".$row['image']."'>"; ?>
			<?php		}
			?>

			<?php 
				$username = $_SESSION['username'];
				$get_user = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
				$get = mysqli_fetch_array($get_user);
					$firstname = $get['firstname'];
					$lastname = $get['lastname'];
			?>

				<h4 style="text-transform: uppercase;"><?php echo $firstname; ?>&nbsp<?php echo $lastname;?></h4>
				<h6 style="position: absolute; top: 76; left: 240; font-size: 15px;"><?php echo "@$username"; ?></h6>
				<p id="editprof">Edit Profile</p>
					<div id="up-form">
					<p>Upload</p>
					<form id="contain-up" method="post" action="profile.php" enctype="multipart/form-data">
							<input type="hidden" name="size" value="1000000">
							<span style="color: green;"> <?php echo $msg; ?></span>
						<div>
							<br>
							<input type="file" name="image">
						</div>

						<div>
							<input type="submit" name="upload" value="Upload image">
						</div>
					</form>
					</div>
			</div>
		</section>

		<section class="ratings">
			<div>
				<h6> 2391 </h6>
				<h5> Posts </h5>
				<h6> 120 </h6>
				<h5> Photos </h5>
				<h6> 120K </h6>
				<h5> Following </h5>
			</div>
		</section>
	</header>

<div class="nav2">
	<h5><a href="#">About</a></h5>
	<h5><a href="#">Photos</a></h5>
	<h5><a class="active" href="#">Posts</a></h5>
</div>
<div id="user-img">
		<?php
		    $db = mysqli_connect("localhost","root","","loveword");
		    $sql = "SELECT image FROM images WHERE username = '$username' ";
		          $result = mysqli_query($db, $sql); 
		          while ($row = mysqli_fetch_array($result)) { ?>
		              <div>
		    <?php echo "<img name='image' width='10%' style='border-radius: 200%; height: 80px; margin-top: 15px; margin-left: 200px;' src='images/".$row['image']."'>"; ?>
		              </div>
		    <?php   }
		?>
		  
</div>
<br><br><br>

<script>
			$(document).ready(function(){
				$("#post_form").submit(function(){
					var post = $("#post-body").val();

					$.post('parse/post.php',{post: post}, function(data){
						$("#response").html(data);
							$("#newsfeed").fadeIn(1100).html(get_post());
					});
					return false;
				});

				function get_post(){
					$.get('get/posts.php', function(data){
						$("#newsfeed").fadeIn(1100).html(data);
					});
				}
				$("#newsfeed").fadeIn(1100).html(get_post());
			});
</script>
<section style="margin-top: 50px;" class="box-form">
	<div id="post">
		<form action='' method='post' id='post_form'>
		<div id="response"></div>
			<textarea id="post-body" name="post" placeholder="Post Something"></textarea>
			<input type="submit" name="submitp" id="submitp" value="Post"/>
		</form>
	</div>
</section>
<br><br><br>
<hr style="background: #EEE;"></hr>


<div id='newsfeed'>

</div>


<script>

$(document).ready(function(){
  $("#up-form").click(function(){
    $(this).animate({height:"100px", width:"460px", borderRadius: "5px", padding: "5px"});
    $(".ratings").hide();
    $("#contain-up").show();
  })


})
</script>
</body>
</html>