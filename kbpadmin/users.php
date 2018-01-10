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
<title>Users</title>
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
            <p><strong>Important Instructions </strong> <b>1.</b> If you find unknown status of user, then kindly edit the user profile and update the status.<b> 2. </b> Records are shown from newest to oldest.</p>
          <section class="box-typical box-typical-padding">
                  <header class="card-header card-header-lg"> Users Settings </header>
                  <div class="card-block">
                  <div class="row">
										<table id="table-xs" class="table table-bordered table-hover table-xs">
											<thead>
											<tr>
												<th>User id</th>
												<th>Username</th>
												<th>Full Name</th>
												<th>Country</th>
												<th>Sponsor</th>
												<th>Earnings</th>
												<th>Package Taken</th>
												<th>Reg. Date</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
												<?php $query="SELECT * FROM  affiliateuser where level=2 ORDER BY id DESC";


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
								$sqlquery11="SELECT name FROM packages where id = $pck";
								$rec211=mysqli_query($con,$sqlquery11);
								@$row211 = mysqli_fetch_row($rec211);
								$refpckname=$row211[0];
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

							  print "
											<tr>
												<td>$id</td>
												<td>$username</td>
												<td>$fname</td>
												<td>$country</td>
												<td>$ref</td>
												<td>$ear</td>
												<td>$refpckname</td>
												<td>$doj</td>
												<td>$status</td>
												<td><div class='btn btn-primary'> <a href='updateuser.php?username=$username' style= 'color: #fff; font-size: 12px; margin: 10px -10px; height: 10px'>Edit</a></div> <br/>
											  <div class='btn btn-danger'><a href='deleteuser.php?username=$username' style= 'color: #fff; font-size: 12px; margin: 10px -10px; height: 10px'>Delete</a> </div> <br/>
											  ";

											  if($lprofile==0)
								{
								print "<div class='btn btn-success' ><a href='launchprofile.php?username=$username' style= 'color: #fff; font-size: 12px; margin: 10px -10px; height: 10px'>Launch</a> </div><br/>";
								}




									print"		  </p></td>
											</tr>";

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
