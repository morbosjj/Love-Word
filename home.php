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
<html>
<title>Love Word</title>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <script src="jquery.js"></script>
</head>
<style>
#content {
  position: absolute;
  background-color: rgb(25,118,210);
  color: white;
  top: 10;
  left: 550;
  font-weight: bold;
  padding: 10px;
  border-radius: 20px;
  display: none;
}

#post-img img{
  position: absolute;
  top: 30;
  left: 10;
  border-radius: 200px;
  width: 60px;
  height: 50px;
}

.post {
  position: relative;
  top: 100;
  margin-bottom: -50px;
  left: 20;
  background-color: white;
  width: 50%;
  height: 100px;
  color: black;
  font-family: 'Century Gothic', sans-serif;
  font-size: 15px;
}
.body-post {
  padding: 15px;
  font-family: 'Roboto condensed', sans-serif;
}
#post-img img{
  position: absolute;
  top: 30;
  left: 10;
  border-radius: 200px;
  width: 60px;
  height: 50px;
}
#author {
  position: relative;
  left: 20;
  top: 5;
  font-weight: bold;
}
#body-post {
  position: absolute;
  top: 40;
  left: 100;
}
</style>
<body>
      <header class="container-head">
        <div  class="background-cover">
            <div id="logo">
              <img src="img/love-word.jpg">
                <nav>
                  <ul>
                    <li><a href="profile.php"><?php echo $_SESSION['username']; ?></a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">About</a></li>
                    <?php if(isset($_SESSION['username'])): ?>
                    <li><a href="home.php?logout=1">Log out</a> </li>
                     <?php endif ?>
                  </ul>
                </nav>
            </div>
            <section class="container-sec1">
              <div>
                <span class="border-love"><h1> Love Word </h1>
                  <h5>"Feeling - Trust - Inspiration" </h5>
                </span>
              </div>
            </section>

        </div>
      </header>



      <section class="container-sec2">
         <div class="bg-subscribe">
            <h2> Subscribes to the latest post. </h2>
              <form>
                <input type="email" name="email" placeholder="Your Email">
                <input class="style-font" type="submit" value="Subscribes">
              </form>
         </div>
      </section>

<script type="text/javascript">
  $(document).ready(function(){
    $("#content").fadeIn(1000);
    $("#content").fadeOut(300);
  });
     
</script>
<section>
            <?php if(isset($_SESSION['success'])): ?>
                        <h3 id="content">
                          <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                          ?>
                        </h3>
            <?php endif ?>
<!--
            <?php if(isset($_SESSION['username'])): ?>
              <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <?php endif ?>
-->   
</section>

<div id="user-img">
<?php
          $db = mysqli_connect("localhost","root","","loveword");
          $sql = "SELECT image FROM images WHERE username = '$username' ";
          $result = mysqli_query($db, $sql); 
          while ($row = mysqli_fetch_array($result)) { ?>
              <div>
        <?php   echo "<img width='10%' name='image' style='border-radius: 200%; height: 60px; margin-top: 30px; margin-left: 10px;' src='images/".$row['image']."'>"; ?>
              </div>
      <?php   }
?>
  
</div>

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
          $.get('get/posts2.php', function(data){
            $("#newsfeed").fadeIn(1100).html(data);
          });
        }
        $("#newsfeed").fadeIn(1100).html(get_post());
      });
</script>

<section class="box-form">
  <div id="post">
  <form action='' method='post' id='post_form'>
    <div id="response"></div>
      <textarea id="post-body" placeholder="What on your mind?"></textarea>
      <input type="submit" name="submitp" value="Post">
  </form>
  </div>
</section>

<div id="newsfeed">
  
</div>

<!--
      <section class="container-sec3">
        <article class="one-third">
          <h4> Feelings </h4>
            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </article>

        <article class="one-third">
          <h4> Trust </h4>
            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </article>

        <article class="one-third">
          <h4> Inspiration </h4>
            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </article>

      </section>

-->

<!--
      <aside>
        <section>
          <iframe src=" http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FLoveWordLV&width=600&colorscheme=light&show_faces=true&border_color&stream=true&header=true&height=435 " scrolling="yes" frameborder="0" allowTransparency="true"> </iframe>
        </section>
      </aside>
-->















      <footer>
        <section class="footer1">
              <a href="#"><img src="img/icons/facebook-logo-outline.svg" onerror="this.src='img/icons/facebook-logo-outline.png'"></a>
              <a href="#"><img src="img/icons/instagram-social-outlined-logo.svg" onerror="this.src='img/icons/instagram-social-outlined-logo.png'"></a>
              <a href="#"><img src="img/icons/twitter-social-outlined-logo.svg" onerror="this.src='img/icons/twitter-social-outlined-logo.png'"></a>
        <section>
      </footer>

      <div class="copyright">
        <h4> Copyright (c) 2017 Love Word All Rights Reserved. </h4>
      </div>
</body>
</html>
