<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="3; URL=http://localhost/Love Word/admin/userdb.php">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<script src="../js/jquery-3.2.1.min.map"></script>
	<script src="../jquery.js"></script>
	<title>User</title>
</head>
<style type="text/css">
	.border-admin {
		border: 5px solid #EEE;
		padding: 20px;
		height: 1200px;
		box-shadow: 1px 1px 5px #EEE;
	}
</style>
<script>
     

</script>
<body>

	<div class="container">
		<div class="border-admin">
			   <h2>User Accounts</h2>

				<table class="table table-hover">
					<form method="POST" action="userdb.php">

				    	<thead>
				    		<tr>
				    			<th> User ID </th>
				    			<th>Username </th>
				    			<th>Firstname </th>
				    			<th>Last name </th>
				    			<th>Action</th>
				    		</tr>
				   		</thead>
				<?php

					$userselect = "SELECT * FROM user";
					$insertselect = mysqli_query($db, $userselect);
					$countuser = mysqli_num_rows($insertselect);
					if ($countuser >= 0) {
				    // output data of each row
				    while($row = mysqli_fetch_assoc($insertselect)) {
				    		$id_user = $row['id_user'];
				    		$username = $row['username'];
				   			$firstname = $row['firstname'];
				   			$lastname = $row['lastname'];
				     ?>
				   		<tbody>
				   			<tr>
				   				<td id="user-animate" name="id_user"> <?php echo $id_user; ?> </td>
				   				<td id="user-animate"> <?php echo $username; ?> </td>
				   				<td id="user-animate"> <?php echo $firstname; ?> </td>
				   				<td id="user-animate"> <?php echo $lastname; ?>  </td>
				   				<td id="user-animate"><input class="btn btn-warning" type="submit" name="delete" value="Delete" onclick="return checkDelete()">&nbsp &nbsp<input id="deluser" class="btn btn-danger" type="submit" name="deleteUserid" value="Delete User" onclick="return checkDelete()"></td>
				   			</tr>
				   		</tbody>
					        
					        
				<?php    	}
					}

					if (isset($_POST['delete'])) {
						$deleteuser = "DELETE user, posts FROM user INNER JOIN posts WHERE user.username = posts.username";
						$succesdel = "Records users were deleted successfully.";
						$resultdel = mysqli_query($db, $deleteuser);
						if ($resultdel) { ?>
							<h5 id="succesdel-animate" style="color: #C9302C; font-weight: bold;"><?php echo $succesdel; ?></h5>
							<?php header("refresh: 5; url= userdb.php"); ?>
				<?php	}else{
							echo "ERROR: Could not able to execute.";
						}
					}
					if (isset($_POST['deleteUserid'])) {
						$deleteuserid = "DELETE user FROM user WHERE id_user = '$id_user' ";
						$succesdel = "Records users were deleted successfully.";
						$resultdel2 = mysqli_query($db, $deleteuserid);
						if ($resultdel2) { 	?>
						<h5 id="succesdel-animate" style="color: #C9302C; font-weight: bold;"><?php echo $succesdel; ?></h5>
							<?php header("refresh: 2; url= userdb.php"); ?>

				<?php	}else{
							echo "ERROR: Could not able to execute.";
						}
					}
				?>
					</form>
				</table>
				<script language="JavaScript" type="text/javascript">
					function checkDelete(){
					    return confirm('Are you sure to delete this account?');
					}
				</script>

				<div>
					<h2>Posts</h2>

				  	<table class="table table-hover">
				  		<thead>
				    		<tr>
				    			<th>User ID</th>
				    			<th>Username</th>
				    			<th>Post</th>
				    			<th>Date</th>
				    		</tr>
				   		</thead>
						<?php

						$userselect = "SELECT * FROM posts";
						$insertselect = mysqli_query($db, $userselect);
						$countuser = mysqli_num_rows($insertselect);
						if ($countuser >= 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($insertselect)) {
					    	$id_user = $row['id_user'];
					    	$username = $row['username'];
					    	$posts = $row['body'];
					    	$date = $row['datepost'];
					     ?>
					        <tbody>
					         <tr id="post-animate">
					        	<td><?php echo $id_user; ?></td>
					        	<td><?php echo $username; ?></td>
					        	<td><?php echo $posts; ?></td>
					        	<td><?php echo $date; ?></td>
					         </tr>
					        </tbody>		    
					    <?php 	}
						}

						?>
					</table>
				</div>




		<br><br><br>
		<div>
			<h2>Audit of User</h2>

				  	<table class="table table-hover">
				  		<thead>
				    		<tr>
				    			<th>User ID</th>
				    			<th>Username</th>
				    			<th>Action</th>
				    			<th>Login Time</th>
				    			<th>Logout Time</th>
				    		</tr>
				   		</thead>
						<?php

						$auditselect = "SELECT * FROM audit";
						$auditselect = mysqli_query($db, $auditselect);
						$countaudit = mysqli_num_rows($auditselect);
						if ($countaudit >= 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($auditselect)) {
					    	$id_user = $row['id_user'];
					    	$username = $row['username'];
					    	$action = $row['action'];
					    	$logtimein = $row['logintime'];
					    	$logtimeout = $row['logouttime'];
					     ?>
					        <tbody>
					         <tr id="post-animate">
					        	<td><?php echo $id_user; ?></td>
					        	<td><?php echo $username; ?></td>
					        	<td><?php echo $action; ?></td>
					        	<td><?php echo $logtimein; ?></td>
					        	<td><?php echo $logtimeout; ?></td>
					         </tr>
					        </tbody>		    
					    <?php 	}
						}

						?>
					</table>
		</div>






		</div>
	</div>

	<script>
	$(document).ready(function(){
		$("#post-animate").delay(500).fadeIn();


			$("#deluser").click(function(){
			    $("#succesdel-animate").delay(500).fadeIn();
	  		})
	})


	</script>

</body>
</html>