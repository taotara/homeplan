<?php
include_once ("includes/connector.php");


		// Delete all session variables
session_destroy();
$msg=" Thank you for choosing us. Your Payment is successful. Click Here to Login. ";
$msg2="Your account is still pending approval, once the payment (if any) is verified, your account will become active and signup bonus(if any) and money to sponsors/Referrals will be credited.";

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

<div class="page-error-box">
	<h2>Thank You, your account has been created but not active yet!</h2>
	<p class="lead color-blue-grey-lighter" style="text-align: left">
		Follow these steps:<br/>
		<ul style="text-align: left; decoration: disk">
			<li>
				Make a payment into our bank account:<br/><br/>
				Bank Name : Fidelity Bank.</br><br/>
	 		 Account Name: Kingbuilder Mkt Mgt Ltd</br><br/>
	 		 Account Number : 4010653718<br/><br/><br/>
			</li>
			<li>Send evidence of payment to email@kbhomeplan.ng</li>
		</ul>
	</p>

	
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
	 </section>
 </div>
</section>
<!-- footer -->
