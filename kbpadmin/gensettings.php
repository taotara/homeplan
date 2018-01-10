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
<title>General Settings</title>
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
            <p><strong>Important Instructions </strong> <b>1.</b> All Details Are Mandatory.</p>

                <section class="box-typical box-typical-padding">
                  <header class="card-header card-header-lg"> General Settings </header>
                  <div class="card-block">
										<?php

            					$query="SELECT * FROM  settings";
                      $result = mysqli_query($con,$query);
                      $i=0;
                      while($row = mysqli_fetch_array($result))
                      {

                        $email="$row[email]";
                        $wlink="$row[wlink]";
                        $ide="$row[invoicedetails]";
                        $coname="$row[coname]";
                        $fblink="$row[fblink]";
                        $tlink="$row[twitterlink]";
                        $gplink="$row[gplink]";
                        $pid="$row[paypalid]";
                        $sno="$row[sno]";
                        $ftrtext="$row[footer]";
                        $hdrtext="$row[header]";
                        $maintain="$row[maintain]";
                        $payzaid="$row[payzaid]";
                        $solidtrustid="$row[solidtrustid]";
                        $solidbuttonid="$row[solidbutton]";
                      }

					          ?>

					  <div class="row">
                    <form class="form-group" action="updategensettings.php" method="post">
                      <div class="form-group">
                        <label>Website Link (Where This Script Is Hosted)</label>
                        <input type="text" value="<?php print $wlink ?>" class="form-control" placeholder="http://www.yourwebsite.com/user/ | Enter url on which this script to be hosted. Invalid link may effect website working " name="wlink" >
                      </div>
					  <input type="hidden" value="<?php print $sno ?>"  name="sno">
					  <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" value="<?php print $coname ?>" class="form-control" placeholder="Enter Company Name To Be Used On Invoice." name="coname">
                      </div>
                      <div class="form-group">
                        <label>Company Full Address</label>
                        <input type="textarea" value="<?php print $ide ?>" class="form-control" placeholder="To be Used On Invoice" name="codetail">
                      </div>

					  <div class="form-group">
                        <label>Admin Email</label>
                        <input type="email" value="<?php print $email ?>" class="form-control" placeholder="For Account information purpose." name="coemail" >
                      </div>


					  <div class="form-group">
					  <label>Enable Paypal Gateway </label>
					  <select name="alwdpaypal" required>
					  <option value=''>Select</option>
						<option value='1'>Yes</option>
						<option value='0'>No</option>

						</select>
					  <br/>
                        <label>Paypal Email</label>
                        <input type="email" value="<?php print $pid ?>" class="form-control" placeholder="To Receive Payments." name="payemail" >

                      </div>

					  <div class="form-group">
					  <label>Enable Payza Gateway </label>
					  <select name="alwdpayza" required>
					  <option value=''>Select</option>
						<option value='1'>Yes</option>
						<option value='0'>No</option>

						</select>
					  <br/>
                        <label>Payza Merchant ID</label>
                        <input type="text" value="<?php print $payzaid ?>" class="form-control" placeholder="To Receive Payments." name="payzaid" >
                      </div>

					  <div class="form-group">
					  <label>Enable Solid Trust Pay Gateway </label>
					  <select name="alwdsolid" required>
					  <option value=''>Select</option>
						<option value='1'>Yes</option>
						<option value='0'>No</option>
						Please follow setup instructions on image given in package named as : how-to-setup-solidtrustpay-ipn.png
						</select>
					  <br/>
                        <label>SolidTrustPay Merchand Id</label>
                        <input type="text" value="<?php print $solidtrustid ?>" class="form-control" placeholder="To Receive Payments." name="solidid" >
                      </div>

					  <div class="form-group">
                        <label>SolidTrustPay Button Password (Secondary Password)</label>
                        <input type="text" value="<?php print $solidbuttonid ?>" class="form-control" placeholder="To Receive Payments." name="solidbuttonid" >
                      </div>
					  <div class="form-group">
					  <label>Enable Cash on delivery Pay Gateway </label>
					  <select name="alwdcash" required>
					  <option value=''>Select</option>
						<option value='1'>Yes</option>
						<option value='0'>No</option>

						</select>
					  <br/>

                      </div>


					  <div class="form-group">
                        <label>Allowed Payment Options (To Fulfil Payment requests) </label>

						<select name="alwdpayment">
						<option value='1'>PayPal (Manual)</option>
						<option value='2'>To Bank(Manual)</option>
						<option value='3'>Both</option>
						</select>
                      </div>

					  <div class="form-group">
                        <label>Facebook Page Link</label>
                        <input type="text" value="<?php print $fblink ?>" class="form-control" placeholder="Including http://fb.com/username" name="fblink" >
                      </div>
					  <div class="form-group">
                        <label>Twitter Link</label>
                        <input type="text" value="<?php print $tlink ?>" class="form-control" placeholder="Whole Link including http://twitter.com/username" name="twitterlink" >
                      </div>
					  <div class="form-group">
                        <label>Google+ Link</label>
                        <input type="text" value="<?php print $gplink ?>" class="form-control" placeholder="Whole Link including http://plus.google.com/username" name="gplink" >
                      </div>
					  <div class="form-group">
                        <label>Header Text</label>
                        <input type="text" value="<?php print $hdrtext ?>" class="form-control" placeholder="To update above Logo at left corner." name="hdrtext" >
                      </div>
					  <div class="form-group">
                        <label>Footer Text (Leave Blank To Show Nothing )</label>
                        <input type="text" value="<?php print $ftrtext ?>" class="form-control" placeholder="To show text on every page" name="ftrtext" >
                      </div>
					  <div class="form-group">


                        <label>Current Website Status</label>
                        <input type="text" value="<?php if ($maintain==0) { print "Website Is Live For Users"; } else if ($maintain==1) { print "Website Is Under Maintenance And Login Is Disabled For Members";} else if ($maintain==2) { print "Website Is Under Maintenance And Registrations Are Disabled For Members";} else if ($maintain==3) { print "Website Is Under Maintenance, Both Registrations And Login Are Disabled For Members";}?>" class="form-control" name="wlink" disabled >
                      </div>
					  <div class="list-group-item">
		  <label>
          Website Status :
		  <select name="maintain">
		  <option value='0'>Go Live</option>
		  <option value='1'>Disable Login</option>
		  <option value='2'>Disable Sign Up</option>
		  <option value='3'>Disable Both</option>
</select>
</label>
</div>


</div>

                     <button type="submit" class="btn btn-rounded btn-inline">Update</button>
                    </form>
                  </div>
                </div>
                </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
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
