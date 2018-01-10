<?php
  include_once ("z_db.php");


  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['femail']))
  {

  $email=mysqli_real_escape_string($con,$_POST['femail']);
  $status=1;
  if($status==1){

  $status = "OK";
  $msg="";
  //checking constraints
  if ( strlen($email) < 1 ){
  $msg=$msg."Please Enter Your Email Id.<BR>";
  $status= "NOTOK";}

  if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
  $msg=$msg."Email Id Not Valid, Please Enter The Correct Email Id .<BR>";
  $status= "NOTOK";
  }


  $result = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where email = '$email'");
  $row = mysqli_fetch_row($result);
  $numrows = $row[0];

  if(($numrows) == 0) {
  $msg=$msg."Your account not found or your account is inactive. Please contact your administrator.<BR>";
  $status= "NOTOK";}

  $sqlquery="SELECT wlink FROM settings where sno=0"; //fetching website from databse
  $rec2=mysqli_query($con,$sqlquery);
  $row2 = mysqli_fetch_row($rec2);
  $wlink=$row2[0]; //assigning website address
  }

  $newpassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%^&*') , 0 , 14 );

  if ( strlen($newpassword) < 8 ){
  $msg=$msg."Password Can not generated, system error. Try again.<BR>";
  $status= "NOTOK";}


  if($status=="OK")
  {
  $sqlquery111="SELECT etext FROM emailtext where code='FORGOTPASSWORD'"; //fetching website from databse
  $rec2111=mysqli_query($con,$sqlquery111);
  $row2111 = mysqli_fetch_row($rec2111);
  $emailtext=$row2111[0]; //assigning email text for email


  $re = mysqli_query($con,"update affiliateuser set password = '$newpassword' where email = '$email'");
  if($re)
  {

  $message=$emailtext;
  $to=$email;
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= 'From: <no-reply@'.$wlink.'>' . "\r\n";
  $subject="Password Request";
  $message.="This is your new password : <b> $newpassword </b><br><br>";
  mail($to,$subject,$message,$headers);

  echo "<br><center><font face='Verdana' size='2' color=red>Your password has been sent to your registered mail id. Please check your junk or spam folder if you do not find in your inbox. </font><br>";
  }
  else
  {
   print "<center><font face='Verdana' size='2' color=red><br>We have found some technical glitch and unable to process your request. Please Ask Admin or try again after some time.</font><br>";
  }
  //updating status if validation passes

  }
  else{
  echo "<br/><br/><br/><center><font face='Verdana' size='2' color=red>$msg</font><br>"; //priting error if found in validation


  }
  }
?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Homeplan</title>

	<link href="images/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="images/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="images/favicon.png" rel="icon" type="image/png">
	<link href="images/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<link rel="stylesheet" href="css/separate/pages/login.min.css">
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box reset-password-box">
                  <div class="sign-avatar">
                      <img src="images/logo2.png" alt="">
                  </div>
                    <header class="sign-title">Reset Password</header>
                    <div class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
                        <input type="text" class="form-control" placeholder="Enter E-Mail"/>
                    </div>
                    <button type="submit" class="btn btn-rounded">Send My Password</button>
                    or <a href="index.php">Sign in</a>
                    <p class="sign-note">or <a href="signup.php">Create An Account</a></p>
                </form>
            </div>
        </div>
    </div><!--.page-center-->

<script src="js/lib/jquery/jquery.min.js"></script>
<script src="js/lib/tether/tether.min.js"></script>
<script src="js/lib/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
    <script type="text/javascript" src="js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="js/app.js"></script>
</body>
</html>
