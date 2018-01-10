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
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Downline</title>

	<link href="images/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="images/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="images/favicon.png" rel="icon" type="image/png">
	<link href="images/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="css/separate/elements/cards.min.css">
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.source.css">
</head>
<body class="with-side-menu">

	<?php include ("includes/header.php"); ?>

	<div class="mobile-menu-left-overlay"></div>
	<?php include ("includes/sidemenu.php"); ?>
  <?php
$sql="SELECT fname,country,pcktaken FROM  affiliateuser WHERE username='".$_SESSION['username']."'";
if ($result = mysqli_query($con, $sql)) {

/* fetch associative array */
while ($row = mysqli_fetch_row($result)) {
print $row[0];
$coun=$row[1];
$pcktaken=$row[2];
$sql2="SELECT name FROM packages WHERE id=$pcktaken";
if ($result2 = mysqli_query($con, $sql2)) {
while ($row2 = mysqli_fetch_row($result2)) {
$pkname=$row2[0];
}
}

}

}

//customized Code Part 1 Start
//fetching level settings
$qu="SELECT * FROM  packages where id = $pcktaken";
$re = mysqli_query($con,$qu);
while($r = mysqli_fetch_array($re))
{
$pckid="$r[id]";
$pckname="$r[name]";
//$pckprice="$r[price]";

$pckcur="$r[currency]";
//$pcksbonus="$r[sbonus]";
$l1="$r[level1]";
$l2="$r[level2]";
$l3="$r[level3]";
$l4="$r[level4]";
$l5="$r[level5]";
$l6="$r[level6]";
$l7="$r[level7]";
//$l8="$r[level8]";
//$l9="$r[level9]";
//$l10="$r[level10]";
$l11="$r[level11]";
$l12="$r[level12]";
$l13="$r[level13]";
$l14="$r[level14]";
$l15="$r[level15]";
$l16="$r[level16]";
//$l17="$r[level17]";
//$l18="$r[level18]";
$l19="$r[level19]";
$l20="$r[level20]";
//fetching elevl settings ends
//Customiezed Code Part 1 Ends
}
?>
	<div class="page-content">
		<div class="container-fluid">
      <section class="card">
				<header class="card-header card-header-lg">
					Downline/Earning
				</header>
        <div class="card-block">
          Red Star = Unverified/Unpaid Account AND Green Star = Verified/Paid Account
        </div>
      </section>
      <div class="cards-grid" data-columns>
				<div class="card-grid-col">
					<article class="card-typical">
						<div class="card-typical-section">
							<div class="user-card-row">
								<div class="tbl-row">
									<div class="tbl-cell">
										<p class="user-card-row-name">Level 1</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-typical-section card-typical-content">
              <?php
              $totalref=0;
              $totalrefear=0;
              $query="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '".$_SESSION['username']."'";
                $result = mysqli_query($con,$query);
              while($row = mysqli_fetch_array($result))
              {
               $ac="$row[active]";
               $countusername="$row[username]";
              	$pcktook="$row[pcktaken]";
              	$qu="SELECT level1 FROM  packages where id = $pcktook";
              $re = mysqli_query($con,$qu);
              while($r = mysqli_fetch_array($re))
              {
              	$ll1="$r[0]";
              }
              if ($ac==1)
              {
              $status="success";
              $totalrefear=$totalrefear+$ll1;
              }
              else
              {
              $status="danger";
              }
              echo "
              <div class='tbl-row'>
                <div class='tbl-cell tbl-cell-status'>
                  <header class='title'><a href='#'>$row[fname]</a></header>
                  <p>E-Mail :  $row[email]</p>
                  <p>Registration Date : $row[doj]</p>
                </div>
                <div class='tbl-cell tbl-cell-status'>
                  <a href='#' class='text-$status font-icon font-icon-star'></a>
                </div>
              </div>
              <div class='vspace-small'>

              </div>
              ";
              }print "
						</div>


            <div class='card-typical-section'>
							<div class='card-typical-linked'>Total Earnings - <b>$pckcur $totalrefear</b></div>
						</div>
            "; ?>
					</article><!--.card-typical-->
				</div><!--.card-grid-col-->

        <div class="card-grid-col">
					<article class="card-typical">
						<div class="card-typical-section">
							<div class="user-card-row">
								<div class="tbl-row">
									<div class="tbl-cell">
										<p class="user-card-row-name">Level 2</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-typical-section card-typical-content">
              <?php
              $totalrefear=0;
              $query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'";


               $result = mysqli_query($con,$query);

              while($row = mysqli_fetch_array($result))
              {
               $ac="$row[active]";
               $countusername="$row[username]";
               $query22="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername'";
               $result22 = mysqli_query($con,$query22);

              while($row22 = mysqli_fetch_array($result22))
              {
               $ac2="$row22[active]";
               $countusername2="$row22[username]";
               $pcktook="$row22[pcktaken]";
              	$qu="SELECT level2 FROM  packages where id = $pcktook";
              $re = mysqli_query($con,$qu);
              while($r = mysqli_fetch_array($re))
              {
              	$ll2="$r[0]";
              }
              if ($ac2==1)
              {
              $status2="success";
              $totalrefear=$totalrefear+$ll2;
              }
              else
              {
              $status2="danger";
              }
                echo "
              <div class='tbl-row'>
                <div class='tbl-cell tbl-cell-status'>
                  <header class='title'><a href='#'>$row22[fname]</a></header>
                  <p>E-Mail : $row22[email] </p>
                  <p>Registration Date : $row22[doj]</small><br>Referred By - $row[fname]</small></p>
                </div>
                <div class='tbl-cell tbl-cell-status'>
                  <a href='#' class='text-$status2 font-icon font-icon-star'></a>
                </div>
              </div>
              ";
              }

              }
              print "
						</div>
						<div class='card-typical-section'>
							<div class='card-typical-linked'>Total Earnings - <b>$pckcur $totalrefear</b> </div>
						</div>
            ";
           ?>
					</article><!--.card-typical-->
				</div><!--.card-grid-col-->

        <div class="card-grid-col">
					<article class="card-typical">
						<div class="card-typical-section">
							<div class="user-card-row">
								<div class="tbl-row">
									<div class="tbl-cell">
										<p class="user-card-row-name">Level 3</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-typical-section card-typical-content">
              <?php
                $totalrefear=0;
                $query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'";

                 $result = mysqli_query($con,$query);

                while($row = mysqli_fetch_array($result))
                {
                 $ac="$row[active]";
                 $countusername="$row[username]";
                 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'";
                 $result22 = mysqli_query($con,$query22);

                while($row22 = mysqli_fetch_array($result22))
                {
                 $ac2="$row22[active]";
                 $countusername2="$row22[username]";
                 $fname22="$row22[fname]";

                 $query33="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername2'";
                 $result33 = mysqli_query($con,$query33);
                 while($row33 = mysqli_fetch_array($result33))
                {
                $ac3="$row33[active]";
                 $countusername3="$row33[username]";
                 $pcktook="$row33[pcktaken]";
                	$qu="SELECT level3 FROM  packages where id = $pcktook";
                $re = mysqli_query($con,$qu);
                while($r = mysqli_fetch_array($re))
                {
                	$ll3="$r[0]";
                }
                if ($ac3==1)
                {
                $status3="success";
                $totalrefear=$totalrefear+$ll3;
                }
                else
                {
                $status3="danger";
                }

                  echo "
              <div class='tbl-row'>
                <div class='tbl-cell tbl-cell-status'>
                  <header class='title'><a href='#'>$row33[fname]</a></header>
                  <p>E-Mail : $row33[email] </p>
                  <p>Registration Date : $row33[doj]</small><br>Referred By - $row22[fname]</small></p>
                </div>
                <div class='tbl-cell tbl-cell-status'>
                  <a href='#' class='text-$status3 font-icon font-icon-star'></a>
                </div>
              </div>
              ";
              }

              }
              }
              print "
						</div>
						<div class='card-typical-section'>
							<div class='card-typical-linked'><b>Total Earnings</b> - $pckcur $totalrefear</div>
						</div>
            ";
           ?>
					</article><!--.card-typical-->
				</div><!--.card-grid-col-->

        <div class="card-grid-col">
					<article class="card-typical">
						<div class="card-typical-section">
							<div class="user-card-row">
								<div class="tbl-row">
									<div class="tbl-cell">
										<p class="user-card-row-name">Level 4</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-typical-section card-typical-content">
              <?php
                $totalrefear=0;

                					$query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'";


                 $result = mysqli_query($con,$query);

                while($row = mysqli_fetch_array($result))
                {
                 $ac="$row[active]";
                 $countusername="$row[username]";
                 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'";
                 $result22 = mysqli_query($con,$query22);

                while($row22 = mysqli_fetch_array($result22))
                {
                 $ac2="$row22[active]";
                 $countusername2="$row22[username]";
                 $fname22="$row22[fname]";

                 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'";
                 $result33 = mysqli_query($con,$query33);
                 while($row33 = mysqli_fetch_array($result33))
                {
                $ac3="$row33[active]";
                 $countusername3="$row33[username]";

                 $query44="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername3'";
                 $result44 = mysqli_query($con,$query44);
                 while($row44 = mysqli_fetch_array($result44))
                {
                 $ac4="$row44[active]";
                 $countusername4="$row44[username]";
                 $pcktook="$row44[pcktaken]";
                	$qu="SELECT level4 FROM  packages where id = $pcktook";
                $re = mysqli_query($con,$qu);
                while($r = mysqli_fetch_array($re))
                {
                	$ll4="$r[0]";
                }

                if ($ac4==1)
                {
                $status4="success";
                $totalrefear=$totalrefear+$ll4;
                }
                else
                {
                $status4="danger";
                }

                echo "
              <div class='tbl-row'>
                <div class='tbl-cell tbl-cell-status'>
                  <header class='title'><a href='#'>$row44[fname]</a></header>
                  <p>E-Mail : $row44[email] </p>
                  <p>Registration Date : $row44[doj]</small><br>Referred By - $row33[fname]</small></p>
                </div>
                <div class='tbl-cell tbl-cell-status'>
                  <a href='#' class='text-$status4 font-icon font-icon-star'></a>
                </div>
              </div>
              ";
              }

              }
              }
              }
              print "
						</div>
						<div class='card-typical-section'>
							<div class='card-typical-linked'><b>Total Earnings</b>- $pckcur $totalrefear</div>
						</div>
            ";
           ?>
					</article><!--.card-typical-->
				</div><!--.card-grid-col-->

        <div class="card-grid-col">
					<article class="card-typical">
						<div class="card-typical-section">
							<div class="user-card-row">
								<div class="tbl-row">
									<div class="tbl-cell">
										<p class="user-card-row-name">Level 5</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-typical-section card-typical-content">
              <?php

                $totalrefear=0;
                					$query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'";


                 $result = mysqli_query($con,$query);

                while($row = mysqli_fetch_array($result))
                {
                 $ac="$row[active]";
                 $countusername="$row[username]";
                 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'";
                 $result22 = mysqli_query($con,$query22);

                while($row22 = mysqli_fetch_array($result22))
                {
                 $ac2="$row22[active]";
                 $countusername2="$row22[username]";
                 $fname22="$row22[fname]";

                 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'";
                 $result33 = mysqli_query($con,$query33);
                 while($row33 = mysqli_fetch_array($result33))
                {
                $ac3="$row33[active]";
                 $countusername3="$row33[username]";

                 $query44="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername3'";
                 $result44 = mysqli_query($con,$query44);
                 while($row44 = mysqli_fetch_array($result44))
                {
                 $ac4="$row44[active]";
                 $countusername4="$row44[username]";
                 $query55="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername4'";
                 $result55 = mysqli_query($con,$query55);
                 while($row55 = mysqli_fetch_array($result55))
                {

                $ac5="$row55[active]";
                 $countusername5="$row55[username]";
                 $pcktook="$row55[pcktaken]";
                $qu="SELECT level5 FROM  packages where id = $pcktook";
                $re = mysqli_query($con,$qu);
                while($r = mysqli_fetch_array($re))
                {
                	$ll5="$r[0]";
                }

                if ($ac5==1)
                {
                $status5="success";
                $totalrefear=$totalrefear+$ll5;
                }
                else
                {
                $status5="danger";
                }


                  echo "
              <div class='tbl-row'>
                <div class='tbl-cell tbl-cell-status'>
                  <header class='title'><a href='#'>$row55[fname]</a></header>
                  <p>E-Mail : $row55[email] </p>
                  <p>Registration Date : $row55[doj]</small><br>Referred By - $row44[fname]</small></p>
                </div>
                <div class='tbl-cell tbl-cell-status'>
                  <a href='#' class='text-$status5 font-icon font-icon-star'></a>
                </div>
              </div>
              ";
              }
              }
              }
              }
              }
              print "
						</div>
						<div class='card-typical-section'>
							<div class='card-typical-linked'><b>Total Earnings</b>- $pckcur $totalrefear</div>
						</div>
            ";
           ?>
					</article><!--.card-typical-->
				</div><!--.card-grid-col-->

        <div class="card-grid-col">
					<article class="card-typical">
						<div class="card-typical-section">
							<div class="user-card-row">
								<div class="tbl-row">
									<div class="tbl-cell">
										<p class="user-card-row-name">Level 6</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-typical-section card-typical-content">
              <?php
                $totalrefear=0;
                $query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'";


                 $result = mysqli_query($con,$query);

                while($row = mysqli_fetch_array($result))
                {
                 $ac="$row[active]";
                 $countusername="$row[username]";
                 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'";
                 $result22 = mysqli_query($con,$query22);

                while($row22 = mysqli_fetch_array($result22))
                {
                 $ac2="$row22[active]";
                 $countusername2="$row22[username]";
                 $fname22="$row22[fname]";

                 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'";
                 $result33 = mysqli_query($con,$query33);
                 while($row33 = mysqli_fetch_array($result33))
                {
                $ac3="$row33[active]";
                 $countusername3="$row33[username]";

                 $query44="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername3'";
                 $result44 = mysqli_query($con,$query44);
                 while($row44 = mysqli_fetch_array($result44))
                {
                 $ac4="$row44[active]";
                 $countusername4="$row44[username]";
                 $query55="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername4'";
                 $result55 = mysqli_query($con,$query55);
                 while($row55 = mysqli_fetch_array($result55))
                {
                $ac5="$row55[active]";
                 $countusername5="$row55[username]";
                $query66="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername5'";
                 $result66 = mysqli_query($con,$query66);
                 while($row66 = mysqli_fetch_array($result66))
                {

                $ac6="$row66[active]";
                 $countusername6="$row66[username]";
                 $pcktook="$row66[pcktaken]";
                $qu="SELECT level6 FROM  packages where id = $pcktook";
                $re = mysqli_query($con,$qu);
                while($r = mysqli_fetch_array($re))
                {
                	$ll6="$r[0]";
                }

                if ($ac6==1)
                {
                $status6="success";
                $totalrefear=$totalrefear+$ll6;
                }
                else
                {
                $status6="danger";
                }

                  echo "
              <div class='tbl-row'>
                <div class='tbl-cell tbl-cell-status'>
                  <header class='title'><a href='#'>$row66[fname]</a></header>
                  <p>E-Mail : $row66[email] </p>
                  <p>Registration Date : $row66[doj]<small><br>Referred By - $row55[fname]</small></p>
                </div>
                <div class='tbl-cell tbl-cell-status'>
                  <a href='#' class='text-$status6 font-icon font-icon-star'></a>
                </div>
              </div>
              ";
              }
              }
              }
              }
              }
              }
              print "
						</div>
						<div class='card-typical-section'>
							<div class='card-typical-linked'><b>Total Earnings</b>- $pckcur $totalrefear</div>
						</div>
            ";
          ?>
					</article><!--.card-typical-->
				</div><!--.card-grid-col-->

        <div class="card-grid-col">
					<article class="card-typical">
						<div class="card-typical-section">
							<div class="user-card-row">
								<div class="tbl-row">
									<div class="tbl-cell">
										<p class="user-card-row-name">Level 7</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-typical-section card-typical-content">
              <?php
                $totalrefear=0;
                $query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'";


                 $result = mysqli_query($con,$query);

                while($row = mysqli_fetch_array($result))
                {
                 $ac="$row[active]";
                 $countusername="$row[username]";
                 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'";
                 $result22 = mysqli_query($con,$query22);

                while($row22 = mysqli_fetch_array($result22))
                {
                 $ac2="$row22[active]";
                 $countusername2="$row22[username]";
                 $fname22="$row22[fname]";

                 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'";
                 $result33 = mysqli_query($con,$query33);
                 while($row33 = mysqli_fetch_array($result33))
                {
                $ac3="$row33[active]";
                 $countusername3="$row33[username]";

                 $query44="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername3'";
                 $result44 = mysqli_query($con,$query44);
                 while($row44 = mysqli_fetch_array($result44))
                {
                 $ac4="$row44[active]";
                 $countusername4="$row44[username]";
                 $query55="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername4'";
                 $result55 = mysqli_query($con,$query55);
                 while($row55 = mysqli_fetch_array($result55))
                {
                $ac5="$row55[active]";
                 $countusername5="$row55[username]";
                $query66="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername5'";
                 $result66 = mysqli_query($con,$query66);
                 while($row66 = mysqli_fetch_array($result66))
                {

                $ac6="$row66[active]";
                 $countusername6="$row66[username]";
                 $query77="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername6'";
                 $result77 = mysqli_query($con,$query77);
                 while($row77 = mysqli_fetch_array($result77))
                {
                	$ac7="$row77[active]";
                 $countusername7="$row77[username]";
                 $pcktook="$row77[pcktaken]";
                $qu="SELECT level7 FROM  packages where id = $pcktook";
                $re = mysqli_query($con,$qu);
                while($r = mysqli_fetch_array($re))
                {
                	$ll7="$r[0]";
                }

                if ($ac7==1)
                {
                $status7="success";
                $totalrefear=$totalrefear+$ll7;
                }
                else
                {
                $status7="danger";
                }

                  echo "
              <div class='tbl-row'>
                <div class='tbl-cell tbl-cell-status'>
                  <header class='title'><a href='#'>$row77[fname]</a></header>
                  <p>E-Mail : $row77[email]<small><br>Referred By - $row66[fname]</small> </p>
                  <p>Registration Date : $row77[doj]</p>
                </div>
                <div class='tbl-cell tbl-cell-status'>
                  <a href='#' class='text-$status7 font-icon font-icon-star'></a>
                </div>
              </div>
              ";

              }
              }
              }
              }
              }
              }
              }
              print "
						</div>
						<div class='card-typical-section'>
							<div class='card-typical-linked'><b>Total Earnings</b>- $pckcur $totalrefear</div>
						</div>
            ";
          ?>
					</article><!--.card-typical-->
				</div><!--.card-grid-col-->

        <div class="card-grid-col">
					<article class="card-typical">
						<div class="card-typical-section">
							<div class="user-card-row">
								<div class="tbl-row">
									<div class="tbl-cell">
										<p class="user-card-row-name">Level 8</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-typical-section card-typical-content">
              <?php
                $totalrefear=0;
                $query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'";


                 $result = mysqli_query($con,$query);

                while($row = mysqli_fetch_array($result))
                {
                 $ac="$row[active]";
                 $countusername="$row[username]";
                 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'";
                 $result22 = mysqli_query($con,$query22);

                while($row22 = mysqli_fetch_array($result22))
                {
                 $ac2="$row22[active]";
                 $countusername2="$row22[username]";
                 $fname22="$row22[fname]";

                 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'";
                 $result33 = mysqli_query($con,$query33);
                 while($row33 = mysqli_fetch_array($result33))
                {
                $ac3="$row33[active]";
                 $countusername3="$row33[username]";

                 $query44="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername3'";
                 $result44 = mysqli_query($con,$query44);
                 while($row44 = mysqli_fetch_array($result44))
                {
                 $ac4="$row44[active]";
                 $countusername4="$row44[username]";
                 $query55="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername4'";
                 $result55 = mysqli_query($con,$query55);
                 while($row55 = mysqli_fetch_array($result55))
                {
                $ac5="$row55[active]";
                 $countusername5="$row55[username]";
                $query66="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername5'";
                 $result66 = mysqli_query($con,$query66);
                 while($row66 = mysqli_fetch_array($result66))
                {

                $ac6="$row66[active]";
                 $countusername6="$row66[username]";
                 $query77="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername6'";
                 $result77 = mysqli_query($con,$query77);
                 while($row77 = mysqli_fetch_array($result77))
                {
                		$countusername7="$row77[username]";
                	$query88="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername7'";
                 $result88 = mysqli_query($con,$query88);
                 while($row88 = mysqli_fetch_array($result88))
                {
                	$ac8="$row88[active]";
                 $countusername8="$row88[username]";
                 $pcktook="$row88[pcktaken]";
                $qu="SELECT level8 FROM  packages where id = $pcktook";
                $re = mysqli_query($con,$qu);
                while($r = mysqli_fetch_array($re))
                {
                	$ll8="$r[0]";
                }

                if ($ac8==1)
                {
                $status8="success";
                $totalrefear=$totalrefear+$ll8;
                }
                else
                {
                $status8="danger";
                }

                  echo "
              <div class='tbl-row'>
                <div class='tbl-cell tbl-cell-status'>
                  <header class='title'><a href='#'>$row88[fname]</a></header>
                  <p>E-Mail : $row88[email] </p>
                  <p>Registration Date : $row88[doj]<small><br>Referred By - $row77[fname]</small></p>
                </div>
                <div class='tbl-cell tbl-cell-status'>
                  <a href='#' class='text-$status8 font-icon font-icon-star'></a>
                </div>
              </div>
              ";
              }
              }
              }
              }
              }
              }
              }
              }
              print "
						</div>
						<div class='card-typical-section'>
							<div class='card-typical-linked'><b>Total Earnings</b>- $pckcur $totalrefear</div>
						</div>
            ";
          ?>
					</article><!--.card-typical-->
				</div><!--.card-grid-col-->





			</div><!--.card-grid-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->

	<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>

  <script src="js/lib/salvattore/salvattore.min.js"></script>
	<script type="text/javascript" src="js/lib/match-height/jquery.matchHeight.min.js"></script>
	<script>
		$(function() {
			$('.card-user').matchHeight();
		});
	</script>

<script src="js/app.js"></script>
</body>
</html>
