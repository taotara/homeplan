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
$toupdate =  mysqli_real_escape_string($con,$_GET['username']);
?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>User Settings</title>
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
            <p><strong>Important Instructions </strong> <b>1.</b> All Details Are Mandatory. <b>2. </b> Enter 0 to deactivate user. <b>3.</b> All amounts should be in integer (1) not decimal (1.0).</p>
          <section class="box-typical box-typical-padding">
                  <header class="card-header card-header-lg"> General Settings |  <a href='deleteuser.php?username=$username'>Delete User</a> </header>
                  <div class="card-block">
										<?php
											$query="SELECT * FROM  affiliateuser where username='$toupdate' ";
											$result = mysqli_query($con,$query);
											$i=0;
											while($row = mysqli_fetch_array($result))
												{
													$id="$row[Id]";
													$username="$row[username]";
													$pass="$row[password]";
													$address="$row[address]";
													$fname="$row[fname]";
													$email="$row[email]";
													$mobile="$row[mobile]";
													$active="$row[active]";
													$doj="$row[doj]";
													$country="$row[country]";
													$ear="$row[tamount]";
													$ref="$row[referedby]";
													$pck="$row[pcktaken]";
													$lprofile="$row[launch]";
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

													$qu="SELECT * FROM  packages where id = $pck";


												 $re = mysqli_query($con,$qu);

												while($r = mysqli_fetch_array($re))
												{
													$pckid="$r[id]";
													$pckname="$r[name]";
													$pckprice="$r[price]";
													$pcktax="$r[tax]";
													$pckcur="$r[currency]";
													$pcksbonus="$r[sbonus]";
												  }
													$total=$pckprice+$pcktax;
												}
										?>
                  <div class="row">
                    <form class="form-group" action="updateusersettings.php" method="post">
					 <input type="hidden" value="<?php print $upid ?>" name="pckmainid">
					<div class="form-group">
                        <label>User Active Status | 0 means unactive and 1 means active</label>
                        <input type="text" value="<?php print $active ?>" class="form-control" placeholder="Enter 0 or 1" name="act">
                      </div>
					  <div class="form-group">
                        <label>User Name</label>
                        <input type="text" value="<?php print $toupdate ?>" class="form-control" placeholder="Enter Username" name="us" disabled>
                      </div>


                        <input type="hidden" value="<?php print $toupdate ?>" class="form-control" placeholder="Enter Username" name="username">

                      <div class="form-group">
                        <label>User Full Name</label>
                        <input type="text" value="<?php print $fname ?>" class="form-control" placeholder="Enter Full Name" name="fname">
                      </div>
					  <div class="form-group">
                        <label>Address</label>
                        <input type="textarea" value="<?php print $address ?>" class="form-control" placeholder="Address" name="address">
                      </div>
                      <div class="form-group">
                        <label>Username Password</label>
                        <input type="textarea" value="<?php print $pass ?>" class="form-control" placeholder="Alphnumeric password" name="password">
                      </div>

					  <div class="form-group">
                        <label>User Email</label>
                        <input type="text" value="<?php print $email ?>" class="form-control" placeholder="email@host.com" name="email" >
                      </div>

						<div class="form-group">
                        <label>Mobile</label>
                        <input type="text" value="<?php print $mobile ?>" class="form-control" placeholder="Like 10,20" name="mobile" >
                      </div>

						<div class="form-group">
                        <label>country</label>
                        <input type="text" value="<?php print $country ?>" class="form-control" placeholder="country" name="country" >
                      </div>

					   <div class="form-group">
                        <label>Earnings</label>
                        <input type="text" value="<?php print $ear ?>" class="form-control" placeholder="Earnings" name="earnings" >
                      </div>

					  <div class="form-group">
                        <label>Referred By</label>
                        <input type="text" value="<?php print $ref ?>" class="form-control" placeholder="Referred By" name="refer" >
                      </div>
					  <div class="form-group">
                        <label>Package Taken</label>
                        <input type="text" value="<?php print $pckname ?>" class="form-control" placeholder="Referred By" name="pck" disabled >
                      </div>
					 <div class="form-group">
                        <label>
            Select Package To Update/Edit :
		  <select name="package">
		  <?php $query="SELECT id,name,price,currency,tax FROM  packages where active=1";


 $result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
	$id="$row[id]";
	$pname="$row[name]";
	$pprice="$row[price]";
	$pcur="$row[currency]";
	$ptax="$row[tax]";
$total=$pprice+$ptax;
  print "<option value='$id'>$pname | Price - $pcur $total </option>";

  }
  ?>

</select>




</div>

                     <button type="submit" class="btn btn-rounded btn-inline">Update User</button>
                    </form>
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
