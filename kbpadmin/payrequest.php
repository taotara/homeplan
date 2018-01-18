<?php
include_once ("../includes/connector.php");
// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['adminidusername'])) {
        print "
				<script language='javascript'>
					window.location = 'index.php';
				</script>
			";
}
?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>Payment Requests</title>
<link href="../images/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
<link href="../images/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
<link href="../images/favicon.png" rel="icon" type="image/png">
<link href="../images/favicon.ico" rel="shortcut icon">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  <link rel="stylesheet" href="../css/lib/font-awesome/font-awesome.min.css">
  <link rel="stylesheet" href="../css/lib/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../css/main.source.css">

</head>
<body class="with-side-menu">
	<?php
		include_once ("../includes/admin_header.php");
	?>
	<!--.site-header-->

	<div class="mobile-menu-left-overlay"></div>
	<?php
		include_once ("../includes/admin_side_menu.php");
	?>
	<!--.side-menu-->
  <div class="page-content">
    <div class="container-fluid">
            <p><strong>Important Instructions </strong> <b>1.</b>Clicking "PAID" will update the payment status. Please verify User's Referral status before making the payment.<b> 2. </b> Records are shown from newest to oldest.</p>
          <section class="box-typical box-typical-padding">
                  <header class="card-header card-header-lg"> Users Payment Requests </header>
                  <div class="card-block">
                  <div class="row">



										<table id="table-xs" class="table table-bordered table-hover table-xs">
											<thead>
											<tr>
												<th>Request Id</th>
												<th>User Id</th>
												<th>User Status</th>
												<th>Request Date And Time</th>
												<th>Amount Requested</th>
												<th>Package Taken</th>
												<th>Payment Status</th>
												<th>Payment To</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
												<?php
											   $q="SELECT * FROM  payments ORDER BY id DESC";


							 $r123 = mysqli_query($con,$q);

							while($ro = mysqli_fetch_array($r123))
							{

								$prid="$ro[id]";
								$pruid="$ro[userid]";
								$pramount="$ro[payment_amount]";
								$prstatus="$ro[payment_status]";
								$prdate="$ro[createdtime]";



							 $query="SELECT * FROM  affiliateuser where Id=$pruid ";


							 $result = mysqli_query($con,$query);
							$i=0;
							while($row = mysqli_fetch_array($result))
							{

								$id="$row[Id]";
								$username="$row[username]";
								$fname="$row[fname]";
								$email="$row[email]";
								$mobile="$row[mobile]";
								$active="$row[active]";
								$doj="$row[doj]";
								$country="$row[country]";
								$ear="$row[tamount]";
								$ref="$row[referedby]";
								$pck="$row[pcktaken]";
								$getpayment="$row[getpayment]";
								$bn="$row[bankname]";
								$acname="$row[accountname]";
								$accno="$row[accountno]";
								$ifsc="$row[ifsccode]";
								$acct="$row[accounttype]";
								if($acct==1)
								{
								$acctype="Current";
								}
								else if($acct==2)
								{
								$acctype="Savings";
								}
								else{
								$acctype="Not Found";
								}

								if($getpayment==1)
								{
								$sendto="PayPal";
								$sendto.="<br>Email=$email";
								}
								else{
								$sendto="To Bank";
								$sendto.="<br> B.Name=$bn<br>Acc.Name=$acname <br>Acc.No=$accno <br>IFSC=$ifsc <br>Acc. Type=$acctype";
								}

								if($active==1)
								{
								$status="Active/Paid";
								}
								else if($active==0)
								{
								$status="UnActive/Unpaid";
								}
								else
								{
								$status="Unknown";
								}

								if($prstatus==1)
								{
								$pstatus="Completed";
								}
								else if($prstatus==0)
								{
								$pstatus="Pending";
								}
								else
								{
								$pstatus="Unknown";
								}

								$qu="SELECT * FROM  packages where id = $pck";


							 $re = mysqli_query($con,$qu);

							while($r = mysqli_fetch_array($re))
							{
								$pckid="$r[id]";
								$pckname="$r[name]";
								$pckprice="$r[price]";
								$pckcur="$r[currency]";
								$pcksbonus="$r[sbonus]";
							  }

							  print "
											<tr>
												<td>$prid</td>
												<td>[$id] $username</td>
												<td>$status</td>
												<td>$prdate</td>
												<td>$pramount</td>
												<td><b>$pckname </b> <br/> $pckprice $pckcur</td>
												<td>$pstatus</td>
												<td>$sendto</td>
												<td><a href='makepayment.php?payid=$prid' class='btn btn-default btn-success' style= 'font-size: 12px; margin: 2px -5px; height: 30px'>Paid</a> <br>
											  <a href='updateuser.php?username=$username' class='btn btn-default  btn-primary' style= 'font-size: 12px; margin: 2px -5px; height: 30px'>Edit User's Info</a> <br/>
											  <a href='deleteuser.php?username=$username' class='btn btn-default  btn-danger' style= 'font-size: 12px; margin: 2px -5px; height: 30px'>Delete User</a> <br/>
											  ";

											  if($active==1)
								{
								print "<a href='deactivateuser.php?username=$username' class='btn btn-default btn-warning' style= 'font-size: 12px; margin: 2px -5px; height: 30px'>De-Activate</a>";
								}
								else if($active==0)
								{
								print "<a href='activateuser.php?username=$username' class='btn btn-default btn-success' style= 'font-size: 12px; margin: 2px -5px; height: 30px'>Activate</a>";
								}
								else
								{
								print "<a href='#' class='btn btn-default btn-sm'>Unknown Status</a>";
								}

									print"		  </p></td>
											</tr>";
						  }
						  }
						  ?>
											</tbody>
										</table>
                  </div>
                </div>
          </section>
        </div>
      </div>
    </section>
  </section>
</section>
<script src="../js/lib/jquery/jquery.min.js"></script>
<script src="../js/lib/tether/tether.min.js"></script>
<script src="../js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../js/plugins.js"></script>

<script src="../js/app.js"></script>
</body>
</html>
