<?php
include_once ("includes/connector.php");
// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
        print "
				<script language='javascript'>
					window.location = 'index.php';
				</script>
			";
}
?>

		  <?php $query="SELECT id,fname,email,doj,active,username,address,pcktaken FROM  affiliateuser where username = '".$_SESSION['username']."'";

 //fetching details for user
 $result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
 $aid="$row[id]";
 $regdate="$row[doj]";
 $name="$row[fname]";
 $address="$row[address]";
 $acti="$row[active]";
 $pck="$row[pcktaken]";

 }
 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']))
{

$subject=mysqli_real_escape_string($con,$_POST['subject']);
$subjetc=$subject."Registered Customer Query";
$message=mysqli_real_escape_string($con,$_POST['message']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$from=$email;



//if(isset($todo) and $todo=="post"){

$status = "OK";
$msg="";
//validation starts
if ( strlen($subject) < 2 ){
$msg=$msg."Enter Subject.<BR>";
$status= "NOTOK";}

if ( strlen($message) < 2 ){
$msg=$msg."Enter Message.<BR>";
$status= "NOTOK";}

if ( strlen($email) < 2 ){
$msg=$msg."Enter Email.<BR>";
$status= "NOTOK";}

$sqlquery="SELECT email FROM settings where sno=0"; //fetching website from databse
$rec2=mysqli_query($con,$sqlquery);
$row2 = mysqli_fetch_row($rec2);
$to=$row2[0]; //assigning website address
//}

if ($status=="OK")
{
// More headers
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <'.$email.'>' . "\r\n";
mail($to,$subject,$message,$headers);
$errormsg= "
<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Success : </br></strong>Your Mail Has Been Sent! Our Representative Will Get Back To You.</div>"; //printing error if found in validation
}
else
{
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
	<title>Contact</title>

	<link href="images/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="images/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="images/favicon.png" rel="icon" type="image/png">
	<link href="images/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.source.css">
</head>
<body class="with-side-menu">

	<?php include ("includes/header.php"); ?>

	<div class="mobile-menu-left-overlay"></div>
	<?php include ("includes/sidemenu.php"); ?>

	<div class="page-content">
		<div class="container-fluid">
      <section class="card">
				<div class="card-block">
					<h5 class="with-border">Make Enquiry</h5>
					<?php
							if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errormsg!=""))
							{
							print $errormsg;
							}
							?>
					<div class="row">
						<div class="col-xs-12">

							<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?> method="post">
								<input type="hidden" name="todo" value="post">
								<div class="form-group">
									<label class="form-label">Email address</label>
									<input type="email" name="email" class="form-control" placeholder="Enter email" required>
								</div>
								<div class="form-group">
									<label class="form-label">Subject</label>
									<input type="text" name="subject" class="form-control" placeholder="Message Subject" required>
								</div>
								 <div class="form-group">
									<label class="form-label">Body</label>
									<textarea rows="4" cols="90" class="form-control" name="message" placeholder="Message" data-autosize required></textarea>
								</div>

								<button type="submit" class="btn btn-rounded">Send</button>
							</form>
						</div>
					</div><!--.row-->

				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->

	<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>

	<script src="js/lib/autosize/autosize.min.js"></script>
	<script src="js/lib/bootstrap-maxlength/bootstrap-maxlength.js"></script>
	<script src="js/lib/bootstrap-maxlength/bootstrap-maxlength-init.js"></script>
	<script src="js/lib/hide-show-password/bootstrap-show-password.min.js"></script>
	<script src="js/lib/hide-show-password/bootstrap-show-password-init.js"></script>

	<script>
		$(function() {
			autosize($('textarea[data-autosize]'));
		});
	</script>
	<script src="js/app.js"></script>
</body>
</html>
