<?php
include_once ("includes/connector.php");

$msg=" Thank you for choosing us. Your Request Has Been Received successfully. ";
$msg2="Your account is still pending approval, kindly contact the admin 08028079361 for more information.";
// Delete all session variables
session_start();
session_destroy();
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
<link rel="stylesheet" href="css/separate/pages/error.min.css">
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="page-center">
			<div class="page-center-in">
<div class="page-error-box">
	<h2><?php print $msg; ?></h2>
	<p><a href="index.php"> Click to go to Home page.</a></p>
	<p class="lead color-blue-grey-lighter">
		<?php print $msg2 ?>
	</p>

 </div>
 <footer id="footer">
  <div class="text-center padder clearfix">
 	 <p> <small><?php $query="SELECT footer from settings where sno=0";


 $result = mysqli_query($con,$query);

 while($row = mysqli_fetch_array($result))
 {
  $footer="$row[footer]";
  print $footer;
  }
  ?></small> </p>
  </div>
 </footer>
<!-- footer -->
</div></div>
