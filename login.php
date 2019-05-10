<?php include('server.php'); ?>
<?php

/*
if(isset($_POST['register'])){
    include "smsGateway.php";
    $smsGateway = new SmsGateway('morbosj@gmail.com', 'destiny30');

    $number = $_POST['number'];
    $password_1 = $_POST['password_1'];
    $deviceID = 52629;
    $number = '+63'.$number;
    $message = "Good day. Your password is ".$password_1;

    $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);
    echo "Success";

}
*/

?>
<html>
<title>Love Word</title>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset= UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style-login.css">
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="css/style-form.css">
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
        <script src="jquery.js"></script>
        <script src="js/angular.min.js"></script> 
</head>
<style type="text/css">
button[disabled="disabled"] {
  opacity: 0.5;
}
input.ng-invalid.ng-dirty{
  border: 1px solid red;
} 
</style>
<body ng-app="">

<section id="container-border">
      <div class="border-love">
          <h1> Love Word </h1>
              <p>"Feeling - Trust - Inspiration" </p>
    
      </div>  
  </section>

<section id="form-before-launch">
   
    <p>Get Started</p>
        <section class="sc">
          <form id="container" method="post" action="login.php">
              <img src="img/love-word.jpg">
                  <div>
                    <?php include('error2.php'); ?><Br/>
                      <div>
                        <input type="text" id="username" name="username" placeholder="Username">
                      </div>

                      <div>
                          <input type="password" id="password" name="password" placeholder="Password">
                      </div>

                      <div id="btn">
                        <button type="submit" name="login" class="btn-login">Login</button><br>
                        <a href="#"> Forget Password? </a><br>
                        <a id="register"> Create Account </a>
                      </div>

                  </div>
          </form>
        </section>
</section>



<section class="sec">
    <form id="form-register" action="login.php" method="POST" name="myForm">
                <div>
                  <h2> Register </h2>
                    <br>
                    <div>
                        <label>First name: </label>
                          <input name="firstname" ng-model="firstname" required><br>
                          <span class="error" ng-show="myForm.firstname.$dirty && myForm.firstname.$invalid">
                          <div class="isa_error">
                            <i class="fa fa-times-circle"></i>
                              First name is required.
                          </div>
                          </span>
                          <br>
                    </div>

                    <div>
                        <label>Last name: </label>
                        <input name="lastname" ng-model="lastname" required><br>
                        <span class="error" ng-show="myForm.lastname.$dirty && myForm.lastname.$invalid">Last name is required.</span>
                        <br>
                    </div>

                    <div>
                        <label>User name: </label>
                        <input name="username" ng-model="username" required><br>
                        <span class="error" ng-show="myForm.username.$dirty && myForm.username.$invalid">User name is required.</span>
                        <br>
                    </div>

                    <div>
                        <label>Email : </label>
                        <input type="email" name="email" ng-model="email" required><br>
                        <span class="error" ng-show="myForm.email.$dirty && myForm.email.$invalid">Its not a email.</span>
                       <span class="success" ng-show="myForm.email.$touched && myForm.email.$valid">Your email is correct.</span>
                        <br>
                    </div>

                    <div>
                        <label>Password:</label>
                        <input name="password_1" ng-model="password_1" ng-minlength="6" required><br>
                        <span class="error" ng-show="myForm.password_1.$dirty && myForm.password_1.$invalid"></span>
                        <span class="error" ng-show="myForm.password_1.$dirty && myForm.password_1.$error.minlength">The Password is too short.</span>
                        <br>
                    </div>

                    <div>
                        <label>Retype Password:</label>
                        <input name="password_2" ng-model="password_2" ng-minlength="6" required><br>
                        <span class="error" ng-show="myForm.password_2.$dirty && myForm.password_2.$invalid"></span>
                        <span class="error" ng-show="myForm.password_2.$dirty && myForm.password_2.$error.minlength">The Password is too short.</span>
                    </div>


                    <br><br>
                      <div id="btn">
                            <button ng-disabled="myForm.$invalid" type="submit" id="submit" name="register" class="btn-login">Register</button><BR>
                      </div>
                </div>
    </form>
</section>


<script>

$(document).ready(function(){
  $("#form-before-launch").click(function(){
    $(this).animate({height:"380px", width:"460px"});
    $(this).children("p").hide();
    $("#container-border").hide();

    $("#container").delay(500).fadeIn();
  })
  $("#register").click(function(){
    $("#form-register").animate({marginLeft:"480px", marginTop:"-380px", marginBottom: "30px", height: "620px", width:"350px"});
    $("#form-register").delay(500).fadeIn();
  })


})
</script>

</body>
</html>