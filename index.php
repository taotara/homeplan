<?php
include_once ("includes/connector.php");
$sql="SELECT maintain FROM  settings WHERE sno=0";
		  if ($result = mysqli_query($con, $sql)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        $main= $row[0];
    }
	if($main==1 || $main==3)
	{
	print "
				<script language='javascript'>
					window.location = 'maintain.php';
				</script>
			";
	}

}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']))
{
$status = "OK"; //initial status
$msg="";
	$username=mysqli_real_escape_string($con,$_POST['username']); //fetching details through post method
     $password = mysqli_real_escape_string($con,$_POST['password']);

if ( strlen($username) < 6 ){
$msg=$msg."Username must be more than 5 char legth<BR>";
$status= "NOTOK";}

if ( strlen($password) < 6 ){ //checking if password is greater then 8 or not
$msg=$msg."Password must be more than 5 char legth<BR>";
$status= "NOTOK";}

if($status=="OK"){

// Retrieve username and password from database according to user's input, preventing sql injection
$query ="SELECT * FROM affiliateuser WHERE (username = '" . mysqli_real_escape_string($con,$_POST['username']) . "') AND (password = '" . mysqli_real_escape_string($con,$_POST['password']) . "') AND (active = '" . mysqli_real_escape_string($con,"1") . "') AND (level = '" . mysqli_real_escape_string($con,"2") . "')";
if ($stmt = mysqli_prepare($con, $query)) {

    /* execute query */
    mysqli_stmt_execute($stmt);

    /* store result */
    mysqli_stmt_store_result($stmt);

    $num=mysqli_stmt_num_rows($stmt);

    /* close statement */
    mysqli_stmt_close($stmt);
}
//mysqli_close($con);
// Check username and password match

if (($num) == 1) {

$sqlquery11="SELECT expiry FROM affiliateuser where username = '$username'"; //fetching expiry date of username from table
$rec211=mysqli_query($con,$sqlquery11);
$row211 = mysqli_fetch_row($rec211);
$expirydate=$row211[0]; //assigning expiry date

$curdate=date("Y-m-d");
if($curdate > $expirydate)
{
   session_start();
           // Set username session variable
           $_SESSION['username'] = $username;

           // Jump to secured page
   		print "
   				<script language='javascript'>
   					window.location = 'dashboard.php?page=dashboard%location=index.php';
   				</script>";
}
else{

session_start();
        // Set username session variable
        $_SESSION['username'] = $username;

        // Jump to secured page
		print "
				<script language='javascript'>
					window.location = 'dashboard.php?page=dashboard%location=index.php';
				</script>";
}

}



else{
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>Username And Password Does Not Matched Or May Be Your Account Is Inactive.
Contact Admin 08028079361 For More Information.</div>"; //printing error if found in validation

}}
else {

$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>".$msg."</div>"; //printing error if found in validation


}
}


?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Home Plan</title>

	<link href="images/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="images/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="images/favicon.png" rel="icon" type="image/png">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<link rel="stylesheet" href="css/separate/pages/login.min.css">
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.source.css">
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
               <div style="margin-left: 45%; margin-right: auto">
                  <a href="http://kbhomeplan.ng/">Back to Home</a>
               </div>
                <form class="sign-box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
                    <div class="sign-avatar">
                        <img src="images/logo2.png" alt="">
                    </div>
                    <header class="sign-title">Sign In</header>
										<?php
														if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errormsg!=""))
														{
														print $errormsg;
														}
														?>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username"/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password"/>
                    </div>
                    <div class="form-group">
                        <div class="checkbox float-left">
                            <!--<input type="checkbox" id="signed-in"/>
                            <label for="signed-in">Keep me signed in</label>-->
                        </div>
                        <div class="float-right reset">
                            <a href="forgotpassword.php">Reset Password</a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-rounded">Sign in</button>
                    <p class="sign-note">Don't Have An Account? <a href="signup.php">Sign up</a></p>
                    <!--<button type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>-->
                </form>
								<footer id="footer">
								  <div class="text-center padder">
								    <p> <small ><?php $query="SELECT footer from settings where sno=0";


								 $result = mysqli_query($con,$query);

								while($row = mysqli_fetch_array($result))
								{
									$footer="$row[footer]";
									print $footer;
									}
								  ?></small> </p>
								  </div>
								</footer>
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
