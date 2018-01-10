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
 ?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Notifications</title>

	<link href="images/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="images/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="images/favicon.png" rel="icon" type="image/png">
	<link href="images/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
		<link rel="stylesheet" href="css/separate/pages/widgets.min.css">
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.source.css">
</head>
<body class="with-side-menu">

	<?php include ("includes/header.php"); ?>

	<div class="mobile-menu-left-overlay"></div>
	<?php include ("includes/sidemenu.php"); ?>

	<div class="">
		<div class="container-fluid">
			<div class="page-content">
				<div class="container-fluid">
		      <section class="card">
						<div class="card-block">
							<h5 class="with-border">Make Enquiry</h5>

							<section class="widget widget-accordion" id="accordion" role="tablist" aria-multiselectable="true">
								<?php
								$query="SELECT * FROM notifications where valid=1 ORDER BY id DESC";
								$result = mysqli_query($con,$query);

								while($row = mysqli_fetch_array($result))
								{
								 $noid="$row[id]";
								 $nosubject="$row[subject]";
								 $nobody="$row[body]";
								 $nodate="$row[posteddate]";
								echo"
								<article class='panel'>
									<div class='panel-heading' role='tab' id='headingOne'>
										<a data-toggle='collapse'
										   data-parent='#accordion'
										   href='#collapseOne'
										   aria-expanded='false'
										   aria-controls='collapseOne'>
											$nosubject - $noid
											<i class='font-icon font-icon-arrow-down'></i>
										</a>
									</div>
									<div id='collapseOne' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
										<div class='panel-collapse-in'>
											<div class='user-card-row'>
												<div class='tbl-row'>
													<div class='tbl-cell tbl-cell-photo'>

													</div>

												</div>
											</div>
											<p>$nobody</p
												<div class='tbl-cell'>
													<p class='user-card-row-location'><small><b> Posted by - Admin on $nodate</b></small></p>
												</div>
										</div>

									</div>
								</article>
								";
								}
								?>
							</section><!--.widget-accordion-->

						</div>
					</section>
				</div><!--.container-fluid-->
			</div><!--.page-content-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->

	<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>

<script src="js/app.js"></script>
</body>
</html>
