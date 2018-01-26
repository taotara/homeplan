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
<title>Profile Settings</title>
<link href="../images/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
<link href="../images/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
<link href="../images/favicon.png" rel="icon" type="image/png">
<link href="../images/favicon.ico" rel="shortcut icon">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  <link href="../css/lib/charts-c3js/c3.min.css" rel="stylesheet" type="text/css">

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
                    <p><strong>Important Instructions </strong> <b>1.</b> All Details Are Mandatory. <b>2. </b> Enter 0 to disable the referral level. <b>3.</b> All amounts should be in integer (1) not decimal (1.0).</p>
                  <section class="box-typical box-typical-padding">
                    <header class="card-header card-header-lg">
                					Profile
                				</header>
                    <div class="card-block">
                              <?php

        					  $query="SELECT * FROM  affiliateuser WHERE username='".$_SESSION['adminidusername']."'";


         $result = mysqli_query($con,$query);
        $i=0;
        while($row = mysqli_fetch_array($result))
        {

        	$name="$row[fname]";
        	$email="$row[email]";
        	$address="$row[address]";
        	$country="$row[country]";
        	$bname="$row[bankname]";
        	$accnamee="$row[accountname]";
        	$accnumber="$row[accountno]";
        	$acctyppe="$row[accounttype]";
        	$ifsc="$row[ifsccode]";

        	}

        					  ?>
                          <div class="panel-body">
                            <div class="tab-content">
                              <div class="tab-pane active" id="home">


        					  <div class="panel-body">
                            <form action="profileupdate.php" method="post">
                              <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" value="<?php print $name ?>" class="form-control" placeholder="Full Name" name="fullname" >
                              </div>
        					  <div class="form-group">
                                <label>Country</label>
                                <input type="text" value="<?php print $country ?>" class="form-control" placeholder="Full Name" name="country" >
                              </div>
        					  <div class="form-group">
                                <label>E-Mail</label>
                                <input type="text" value="<?php print $email ?>" class="form-control" placeholder="Full Name" name="email" >
                              </div>
        					  <div class="form-group">
                                <label>Address</label>
                                <input type="text" value="<?php print $address ?>" class="form-control" placeholder="Full Name" name="address" >
                              </div>
        					   <div class="form-group">
                                <label>Account Type</label>
                                 <select name="acctype" required>
        	<option value='0'>Select Type</option>
        	<option value='1'>Current</option>
        	<option value='2'>Savings</option>

        </select>
                              </div>
        					  <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" value="<?php print $bname ?>" class="form-control" placeholder="Bank Name" name="bankname">
                              </div>
        					  <div class="form-group">
                                <label>Account Name</label>
                                <input type="text" value="<?php print $accnamee ?>" class="form-control" placeholder="Account Holder Name" name="accname">
                              </div>
        					  <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" value="<?php print $accnumber ?>" class="form-control" placeholder="Bank Account Number" name="accno">
                              </div>
        					  <div class="form-group">
                                <label>IFSC Code</label>
                                <input type="text" value="<?php print $ifsc ?>" class="form-control" placeholder="IFSC Code" name="ifsccode">
                              </div>
        					  <input type="hidden" value=""  name="sno">
        					  <div class="form-group">
                                <label>Password</label>
                                <input type="password" value="" class="form-control" placeholder="Alphnumeric Password" name="p1" required>
                              </div>
                              <div class="form-group">
                                <label>Password Again</label>
                                <input type="password" value="" class="form-control" placeholder="Alphanumeric Password Again" name="p2" required>
                              </div>



        </div>

                             <button type="submit" class="btn btn-rounded btn-inline">Update/Edit</button>
                            </form>
                          </div>

        					  </div>



                            </div>

                      </div>
                  </section>
      </div>
    </div>
  </div>
<!-- Bootstrap -->
<!-- App -->
<script src="../js/lib/jquery/jquery.min.js"></script>
<script src="../js/lib/tether/tether.min.js"></script>
<script src="../js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../js/plugins.js"></script>

<script src="../js/lib/d3/d3.min.js"></script>
<script src="../js/lib/charts-c3js/c3.min.js"></script>
<script src="../js/lib/charts-c3js/c3js-init.js"></script>

<script src="../js/app.js"></script>
</body>
</html>
