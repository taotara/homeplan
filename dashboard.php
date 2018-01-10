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
$payto=$_SESSION['username'];



if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo']) && (($_POST['todo'])=="paymentpost"))
{

$username=mysqli_real_escape_string($con,$_SESSION['username']);

$status = "OK"; //initial status
$msg="";



$rr=mysqli_query($con,"SELECT Id FROM affiliateuser WHERE username = '$username'");
$r = mysqli_fetch_row($rr);
$uid = $r[0];

$rr=mysqli_query($con,"SELECT pcktaken FROM affiliateuser WHERE username = '$username'");
$r = mysqli_fetch_row($rr);
$pc = $r[0];

$rr=mysqli_query($con,"SELECT mpay FROM packages WHERE id='$pc'");
$r = mysqli_fetch_row($rr);
$mpay = $r[0];

$rr=mysqli_query($con,"SELECT tamount FROM affiliateuser WHERE username = '$username'");
$r = mysqli_fetch_row($rr);
$nr = $r[0];

if($nr<$mpay){
$msg=$msg."You are not eligible for payment!!!! Contact support for more info.<BR>";
$status= "NOTOK";
}

if($status=="OK")
{
$res11=mysqli_query($con,"update affiliateuser set tamount=0 where username='$username'");
$res1=mysqli_query($con,"INSERT INTO payments (userid, payment_amount, createdtime) VALUES ('$uid', '$nr', NOW())");

if($res1)
{
$errormsg= "
<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Success : </br></strong>Your Payment Request Has Been Sent! Payment Will be Processed After Successful Verification On Time.</div>"; //printing error if found in validation

}
else
{
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help. </div>"; //printing error if found in validation


}


}
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
</head>
<body class="with-side-menu">

	<?php include ("includes/header.php"); ?>

	<div class="mobile-menu-left-overlay"></div>

	<?php include ("includes/sidemenu.php"); ?>

	<div class="page-content">
		<div class="container-fluid">
      <div class="row">
        <section>
          <header class="card-header card-header-lg">
  					Dashboard
  				</header>
          <div class="card-block invoice">
            <h5>Welcome
            <?php
                $sql="SELECT fname FROM  affiliateuser WHERE username='".$_SESSION['username']."'";
                if ($result = mysqli_query($con, $sql)) {

                /* fetch associative array */
                while ($row = mysqli_fetch_row($result)) {
                print $row[0];
                }

                }
                if($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                    print $errormsg;
                    }
            ?>
            </h5>
          </div>
        </section>
      </div>
      <div class="row">
        <?php $query="SELECT id,fname,email,doj,active,username,address,pcktaken,tamount FROM  affiliateuser where username = '".$_SESSION['username']."'";
          $result = mysqli_query($con,$query);

          while($row = mysqli_fetch_array($result))
          {
          $aid="$row[id]";
          $regdate="$row[doj]";
          $name="$row[fname]";
          $address="$row[address]";
          $acti="$row[active]";
          $pck="$row[pcktaken]";
          $ear="$row[tamount]";

          }
        ?>
        <?php $query="SELECT * FROM  packages where id=$pck";
          $result = mysqli_query($con,$query);

          while($row = mysqli_fetch_array($result))
          {
          $pname="$row[name]";
          $pdetails="$row[details]";
          $pprice="$row[price]";
          $pcur="$row[currency]";
          $ptax="$row[tax]";
          $mpay="$row[mpay]";
          }
          @$left=$mpay-$ear;
          @$pro=(($ear/$mpay)*100);
        ?>
          <div class="col-xl-6">
              <div class="chart-statistic-box">
                  <div class="chart-txt">
                      <div class="chart-txt-top">
                          <p><span class="unit"><?php @print $pcur; ?></span><span class="number"><?php print $ear; ?></span></p>
                          <p class="caption">Earnings</p>
                      </div>
                      <div class="vspace">

                      </div>
                      <div class="chart-txt-top">
                        <?php
                            $result = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where referedby = '".$_SESSION['username']."'");
                            $row = mysqli_fetch_row($result);
                            $numrows = $row[0];

                        ?>
                          <p><span class="number"><?php print $numrows; ?></span></p>
                          <p class="caption">Referrals (direct)</p>
                      </div>
                  </div>

              </div><!--.chart-statistic-box-->
          </div><!--.col-->
          <div class="col-xl-6">
              <div class="row">
                  <div class="col-sm-6">
                      <article class="statistic-box red">
                        <?php
                            $sqlquery="SELECT username,country,doj,pcktaken FROM affiliateuser where referedby='".$_SESSION['username']."' ORDER BY Id DESC LIMIT 1"; //fetching website from databse
                            $rec2=mysqli_query($con,$sqlquery);
                            $row2 = mysqli_fetch_row($rec2);
                            $referusername=$row2[0];
                            $refcountry=$row2[1];
                            $refdate=$row2[2];
                            $refpckid=$row2[3];
                            $sqlquery11="SELECT name FROM packages where id = $refpckid"; //fetching no of days validity from package table from databse
                            $rec211=mysqli_query($con,$sqlquery11);
                            @$row211 = mysqli_fetch_row($rec211);
                            $refpckname=$row211[0]; //assigning we
                        ?>
                          <div>
                              <div class="number">YOUR LAST REFERRAL</div>
                              <div class="caption"><div><?php print $referusername; ?></div></div>
                          </div>
                      </article>
                  </div><!--.col-->
                  <div class="col-sm-6">
                      <article class="statistic-box purple">
                          <div>
                              <div class="number">PACKAGE PURCHASED</div>
                              <div class="caption"><div><?php print $refpckname; ?></div></div>
                          </div>
                      </article>
                  </div><!--.col-->
                  <div class="col-sm-6">
                      <article class="statistic-box yellow">
                          <div>
                              <div class="number">LOCATION</div>
                              <div class="caption"><div><?php print $refcountry; ?></div></div>
                          </div>
                      </article>
                  </div><!--.col-->
                  <div class="col-sm-6">
                      <article class="statistic-box green">
                          <div>
                              <div class="number">DATE</div>
                              <div class="caption"><div><?php print $refdate; ?></div></div>
                          </div>
                      </article>
                  </div><!--.col-->

              </div><!--.row-->
          </div><!--.col-->
      </div><!--.row-->
      <section class="card">
        <header class="card-header card-header-lg">
          Your Referral Invite URL
        </header>
        <div class="card-block">
          <p class="card-text">
            <input type="text" value="<?php $query121="SELECT * FROM  settings"; $result121 = mysqli_query($con,$query121);
              $i=0;
              while($row121 = mysqli_fetch_array($result121))
              {


              $wlink="$row121[wlink]";

              }


              $pathu="/User/signup.php?aff=";		 print $wlink.$pathu.$_SESSION['username'] ?>" class="form-control" placeholder="Your Invite URL" name="inviteurl" >

          </p>
        </div>
      </section>

      <section class="card">
        <header class="card-header card-header-lg">
          Next Payment
        </header>
        <div class="card-block">
          <p class="card-text">
            <div class="progress-with-amount">
    					<progress class="progress" value="<?php print $pro ?>" max="100">25%</progress>
    					<div class="progress-with-amount-number"><?php print $pro ?>%</div>
    				</div>
            <h3 align="center">
              <?php
      					if($left<=0)
      					{
      					$congomsg1="Congratulations!!!! You can now submit request for payment. </br>";
      					print $congomsg1;
      					$congomsg2="<form action='";
      					print $congomsg2;
      					echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8");
      					$congomsg3="' method='post'></br><input type='hidden' name='todo' value='paymentpost'><button type='submit' class='btn btn-rounded btn-inline'>Request Payment</button>  </form> ";
      					print $congomsg3;
      					}

      					else
      					{
      					print " Earn <b>$pcur $left</b> more to become eligible for payment. ";
      					}

      				?>
            </h3>
          </p>
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
