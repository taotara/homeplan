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
				  <?php $query="SELECT id,fname,email,doj,active,username,address,pcktaken,expiry FROM  affiliateuser where username = '".$_SESSION['username']."'";


		 $result = mysqli_query($con,$query);

		while($row = mysqli_fetch_array($result))
		{
		 $aid="$row[id]";
		 $regdate="$row[doj]";
		 $name="$row[fname]";
		 $address="$row[address]";
		 $acti="$row[active]";
		 $pck="$row[pcktaken]";
		 $regexpiry="$row[expiry]";

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
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.source.css">
		<link rel="stylesheet" href="css/separate/pages/invoice.min.css">
</head>
<body class="with-side-menu">

	<?php include ("includes/header.php"); ?>

	<div class="mobile-menu-left-overlay"></div>
	<?php include ("includes/sidemenu.php"); ?>

  <div class="page-content">
		<div class="container-fluid">
			<section class="card">
				<header class="card-header card-header-lg">
					Invoice
				</header>
				<?php $query="SELECT * FROM  settings";
					$result = mysqli_query($con,$query);

					while($row = mysqli_fetch_array($result))
					{
					 $id="$row[invoicedetails]";
					 $co="$row[coname]";

					 }
				 ?>
				<div class="card-block invoice">
					<div class="row">
						<div class="col-lg-6 company-info">
							<h5><?php print $co ?></h5>

							<div class="invoice-block">
								<div><?php print $id ?></div>
							</div>

							<div class="invoice-block">
								<h5>Invoice To:</h5>
								<div><?php print $name ?></div>
								<div>
									<?php print $address ?>
								</div>
							</div>
						</div>
						<div class="col-lg-6 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>INVOICE #<?php print $aid ?></h5>
								<div>Registration Date:  <?php print $regdate ?></div>
								<div>Expiry Date: <?php print $regexpiry ?></div>
							</div>

							<div class="payment-details">
								<strong>Payment Status</strong>
								<table>
									<tr>
										<td>Order date:</td>
										<td> <?php print $regdate ?></td>
									</tr>
									<tr>
										<?php
											if ($acti==1)
											{
											$stats="<span class='label bg-success'>Completed- Paid/Activated</span><br>";
											}
											else
											{
											$stats="<span class='label bg-danger'>Pending - Activation/Payment</span><br>";
											}
										?>
										<td>Order status:</td>
										<td><?php print $stats ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row table-details">
						<div class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Description</th>
										<th>Quantity</th>
										<th>Unit Cost</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php $query="SELECT * FROM  packages where id=$pck";
									 $result = mysqli_query($con,$query);

									while($row = mysqli_fetch_array($result))
									{
									 $pname="$row[name]";
									 $pdetails="$row[details]";
									 $pprice="$row[price]";
									 $pcur="$row[currency]";
									 $ptax="$row[tax]";
									 }
								 ?>
									<tr>
										<td><?php print $pdetails ?></td>
										<td><?php print $pck ?></td>
										<td><?php echo $pcur; echo $pprice?></td>
										<td><?php echo $pcur; echo $pprice?></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-7 terms-and-conditions">
							<!--<strong>Terms and Conditions</strong>
							Thank you for your business. We do expect payment within 21 days, so please process this invoice within that time. There will be a 1.5% interest charge per month on late invoices.-->
						</div>
						<div class="col-lg-5 clearfix">
							<div class="total-amount">
								<div>Sub - Total amount: <b><?php echo $pcur; echo $pprice?></b></div>
								<div>Tax/VAT: <?php echo $pcur; echo $ptax?></div>
								<div>Grand Total: <span class="colored"><?php echo $pcur; echo $pprice+$ptax ?></span></div>
								<div class="actions">
									<!--<button class="btn btn-rounded btn-inline">Send</button> -->
									<button class="btn btn-rounded btn-inline" onClick="window.print();">Print</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->

	<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>

<script src="js/app.js"></script>
</body>
</html>
