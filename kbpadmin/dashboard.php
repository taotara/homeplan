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
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Homeplan</title>

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
      <div class="row">
        <section>
          <header class="card-header card-header-lg">
  					Dashboard
  				</header>
          <div class="card-block invoice">
            <h5>Welcome back,
                <?php
                    $sql="SELECT fname FROM  affiliateuser WHERE username='".$_SESSION['adminidusername']."'";
                    if ($result = mysqli_query($con, $sql)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_row($result)) {
                    print $row[0];
                    }

                    }
                ?>
            </h5>
          </div>
        </section>
      </div>
      <div class="row">
         <?php
            $query="SELECT id,fname,email,doj,active,username,address,pcktaken,tamount FROM  affiliateuser where username = '".$_SESSION['adminidusername']."'";

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
        <?php $query="SELECT orderid,price FROM  paypalpayments";
            $result = mysqli_query($con,$query);
            $totalpayments=0;
            while($row = mysqli_fetch_array($result))
            {
                $oid="$row[orderid]";
                $result2 = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where Id='$oid' and level = 2 and active = 1");
                $row22 = mysqli_fetch_row($result2);
                $toid = $row22[0];
                if($toid==1)
                    {
                        $totalpayments = $totalpayments + $ppayment="$row[price]";
                    }
            }
        ?>
          <div class="col-xl-4">
              <div class="chart-statistic-box">
                  <div class="chart-txt">
                      <div class="chart-txt-top">
                          <p><span class="unit">NGN</span><span class="number"><?php print $totalpayments ?></span></p>
                          <p class="caption">Sum Total Amount Generated From Revenue </p>
                      </div>
                      <div class="vspace">

                      </div>
                      <div class="chart-txt-top">
                          <?php
                              $result = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where level = 2");
                              $row = mysqli_fetch_row($result);
                              $totalusers = $row[0];
                          ?>
                          <p><span class="number"><?php print $totalusers ?></span></p>
                          <p class="caption">Total Registered Users</p>
                      </div>
                  </div>

              </div><!--.chart-statistic-box-->
          </div><!--.col-->
          <div class="col-xl-8">
              <div class="row">
                  <div class="col-sm-6">
                      <article class="statistic-box green">
                          <?php
                              $result = mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE active = 1 AND signupcode <> 0");
                              $row = mysqli_fetch_row($result);
                              $totalactiveusers = $row[0];
                          ?>
                          <div>
                              <div class="number"><?php print $totalactiveusers ?></div>
                              <div class="caption"><div>Total Paid/Active Users</div></div>
                          </div>
                      </article>
                  </div><!--.col-->
                  <div class="col-sm-6">
                      <article class="statistic-box red">
                          <?php
                              $result = mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE active = 0 AND signupcode <> 0");
                              $row = mysqli_fetch_row($result);
                              $totalinactiveusers = $row[0];
                          ?>
                          <div>
                              <div class="number"><?php print $totalinactiveusers ?></div>
                              <div class="caption"><div>Total Unpaid/Inactive Users</div></div>
                          </div>
                      </article>
                  </div><!--.col-->
                  <div class="col-sm-6">
                      <article class="statistic-box red">
                          <?php
                              $result = mysqli_query($con,"SELECT COUNT(*) FROM `payments` WHERE payment_status = 0");
                              $row = mysqli_fetch_row($result);
                              $pendingpayment = $row[0];
                          ?>
                          <div>
                              <div class="number"><?php print $pendingpayment ?></div>
                              <div class="caption"><div>Pending withdrawal requests</div></div>
                          </div>
                      </article>
                  </div><!--.col-->
                  <div class="col-sm-6">
                      <article class="statistic-box purple">
                          <?php
                              $result = mysqli_query($con,"SELECT COUNT(*) FROM `affiliateuser` WHERE doj = date(now())");
                              $row = mysqli_fetch_row($result);
                              $totaRegisteredToday = $row[0];
                          ?>
                          <div>
                              <div class="number"><?php print $totaRegisteredToday ?></div>
                              <div class="caption"><div>Total registered users today</div></div>
                          </div>
                      </article>
                  </div><!--.col-->

              </div><!--.row-->
          </div><!--.col-->
      </div><!--.row-->
      <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-sm-4">
                    <article class="statistic-box purple">
                        <?php
                            $result = mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE WEEK(doj) = WEEK(CURDATE())");
                            $row = mysqli_fetch_row($result);
                            $totalreguseredweek = $row[0];
                        ?>
                        <div>
                            <div class="number"><?php print $totalreguseredweek ?></div>
                            <div class="caption"><div>Total Registered Users This Week</div></div>
                        </div>
                    </article>
                </div><!--.col-->
                <div class="col-sm-4">
                    <article class="statistic-box purple">
                        <?php
                            $result = mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE MONTH(doj) = MONTH(CURDATE())");
                            $row = mysqli_fetch_row($result);
                            $totalregisteredmonth = $row[0];
                        ?>
                        <div>
                            <div class="number"><?php print $totalregisteredmonth ?></div>
                            <div class="caption"><div>Total Registered Users This Month</div></div>
                        </div>
                    </article>
                </div><!--.col-->
                <div class="col-sm-4">
                    <article class="statistic-box purple">
                        <?php
                            $result = mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE YEAR(doj) = YEAR(CURDATE())");
                            $row = mysqli_fetch_row($result);
                            $totalregisteredyear = $row[0];
                        ?>
                        <div>
                            <div class="number"><?php print $totalregisteredyear ?></div>
                            <div class="caption"><div>Total Registered Users This Year</div></div>
                        </div>
                    </article>
                </div><!--.col-->

                <div class="col-sm-6">
                    <article class="statistic-box yellow">
                        <?php
                            $result = mysqli_query($con,"SELECT IFNULL (SUM(payment_amount), 0) FROM `payments` WHERE payment_status = 1");
                            $row = mysqli_fetch_row($result);
                            $totalwithdrawn = $row[0];
                        ?>
                        <div>
                            <div class="number"><span class="unit">NGN</span><?php print $totalwithdrawn ?></div>
                            <div class="caption"><div>Sum Total Ammount Withdrawn by Members</div></div>
                        </div>
                    </article>
                </div><!--.col-->
                <div class="col-sm-6">
                    <article class="statistic-box yellow">
                        <?php
                            $result = mysqli_query($con,"SELECT IFNULL (SUM(tamount), 0) FROM `affiliateuser` WHERE signupcode <> 0");
                            $row = mysqli_fetch_row($result);
                            $totalwalletbalancemembers = $row[0];
                        ?>
                        <div>
                            <div class="number"><span class="unit">NGN</span><?php print $totalwalletbalancemembers ?></div>
                            <div class="caption"><div>Sum Total Wallet Balance Of All Members </div></div>
                        </div>
                    </article>
                </div><!--.col-->
                <div class="col-sm-6">
                    <article class="statistic-box yellow">
                        <?php
                            $balance = $totalpayments - ($totalwithdrawn + $totalwalletbalancemembers);
                        ?>
                        <div>
                            <div class="number"><span class="unit">NGN</span><?php print $balance ?></div>
                            <div class="caption"><div>Balance</div></div>
                        </div>
                    </article>
                </div><!--.col-->

            </div><!--.row-->
        </div><!--.col-->
      </div>
      <!--<div class="row">
          <div class="col-lg-4">
              <section class="card">
                  <header class="card-header">
                      Pie Chart
                  </header>
                  <div class="card-block">
                      <div id="pie-chart"></div>
                  </div>
              </section>
          </div>
          <div class="col-lg-4">
              <section class="card">
                  <header class="card-header">
                      Donut Chart
                  </header>
                  <div class="card-block">
                      <div id="donut-chart"></div>
                  </div>
              </section>
          </div>
          <div class="col-lg-4">
              <section class="card">
                  <header class="card-header">
                      Gauge Chart
                  </header>
                  <div class="card-block">
                      <div id="gauge-chart"></div>
                  </div>
              </section>
          </div>
      </div>
      <section class="card">
        <header class="card-header card-header-lg">
          Your Referral Invite URL
        </header>
        <div class="card-block">
          <p class="card-text">
            URL
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
    					<progress class="progress" value="25" max="100">25%</progress>
    					<div class="progress-with-amount-number">25%</div>
    				</div>
            <h3 align="center">
              nxt pay
            </h3>
          </p>
        </div>
    </section>-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->

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
