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
	<title>Payments History</title>

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
      <section class="card">
				<header class="card-header card-header-lg">
					Payment History
				</header>
				<div class="card-block invoice">
						<ul>
		<!-- Started Fetching Downline Of User-->
		<?php $query="SELECT Id FROM  affiliateuser where username = '".$_SESSION['username']."'";


$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
$uid="$row[Id]";
}

$query2="SELECT * FROM  payments where userid = '$uid'";


$result2 = mysqli_query($con,$query2);

while($row2 = mysqli_fetch_array($result2))
{
$pa="$row2[payment_amount]";
$ps="$row2[payment_status]";
$ct="$row2[createdtime]";

if ($ps==1)
{
$status="success";
}
else
{
$status="danger";
}

echo "<li>

									<div class='pull-right text-$status m-t-sm'> <i class='fa fa-circle'></i> </div>
									<div class='media-body'>
										<div><a href='#'>$row2[createdtime]</a></div>
									 <small class='text-muted'>Payment Amount : $row2[payment_amount]</small> <br></div>
								</div>
							</li> ";

//echo $row['fname'] . " " . $row['email'];
//echo "<br>";
}


//if ($result = mysqli_query($con, $query)) {

//mysqli_field_seek($result, 0);

/* Get field information for all fields */
//while ($finfo = mysqli_fetch_field($result)) {

/* echo "<li class='list-group-item'>
								<div class='media'> <span class='pull-left thumb-sm'><img src='images/a1.jpg' alt='John said' class='img-circle'></span>
									<div class='pull-right text-success m-t-sm'> <i class='fa fa-circle'></i> </div>
									<div class='media-body'>
										<div><a href='#'>$finfo->fname</a></div>
										<small class='text-muted'>E-Mail : $row[1] </small> <br><small class='text-muted'>E-Mail : $row[2] </small><br><small class='text-muted'>Date Of Joining : $row[3] </small></div>
								</div>
							</li> ";

	//printf("Name:     %s\n", $finfo->fname);
	//printf("E-Mail:    %s\n", $finfo->email);
	//printf("max. Len: %d\n", $finfo->doj);
	//printf("Flags:    %d\n", $finfo->active);
	//printf("Type:     %d\n\n", $finfo->type);
}
mysqli_free_result($result);
}


/* if ($result = $con->query( $query)) {


/* fetch row
$row = $result->fetch_row();
echo "<li class='list-group-item'>
								<div class='media'> <span class='pull-left thumb-sm'><img src='images/a1.jpg' alt='John said' class='img-circle'></span>
									<div class='pull-right text-success m-t-sm'> <i class='fa fa-circle'></i> </div>
									<div class='media-body'>
										<div><a href='#'>$row[0]</a></div>
										<small class='text-muted'>E-Mail : $row[1] </small> <br><small class='text-muted'>E-Mail : $row[2] </small><br><small class='text-muted'>Date Of Joining : $row[3] </small></div>
								</div>
							</li> ";

//printf ("Name: %s  E-Mail: %s\n", $row[0], $row[1]);

/* free result set*/
//$result->close();
//}
//$i=0;
//$num=$num1 - 1;
//while ($i < $num1)
//{
//$fname=mysqli_fetch_field($result,$num,"fname");
//$eemail=mysql_result($result,$num,"email");
//$ddoj=mysql_result($result,$num,"doj");
//$status=mysql_result($result,$num,"active");
//$i=$i+1;
//$num=$num-1;
//if ($active==1)
//{
//$status="Verified";
//}
//else
//{
//$status="Not Verified";
//}
//print "$fname";
//echo "	<tr><td>$i</td><td>$fname</td><td>$eemail</td><td class='price'>$ddoj</td><td class='total'>$status</td></tr>" ;


//} */
?>
<!-- End Fetching Downline Of User-->



						</ul>
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
