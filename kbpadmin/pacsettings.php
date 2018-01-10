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
<title>Packages Settings</title>
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
            <p><strong>Important Instructions </strong> <b>1.</b> All Details Are Mandatory. <b>2. </b> Enter 0 to disable the referral level. <b>3.</b> Enter amounts in integer (1) or decimal (1.0).</p>
          <section class="box-typical box-typical-padding">
                  <header class="card-header card-header-lg"> Packages Settings </header>

                  <section class="tabs-section">
            				<div class="tabs-section-nav tabs-section-nav-icons">
            					<div class="tbl">
            						<ul class="nav" role="tablist">
            							<li class="nav-item">
            								<a class="nav-link active" href="#tabs-1-tab-1" role="tab" data-toggle="tab">
            									<span class="nav-link-in">
            										<i class="glyphicon glyphicon-plus"></i>
            										Create Packages
            									</span>
            								</a>
            							</li>
            							<li class="nav-item">
            								<a class="nav-link" href="#tabs-1-tab-2" role="tab" data-toggle="tab">
            									<span class="nav-link-in">
            										<span class="glyphicon glyphicon-refresh"></span>
            										Update Packages
            									</span>
            								</a>
            							</li>
            							<li class="nav-item">
            								<a class="nav-link" href="#tabs-1-tab-3" role="tab" data-toggle="tab">
            									<span class="nav-link-in">
            										<i class="glyphicon glyphicon-remove"></i>
            										Deactivate Packages
            									</span>
            								</a>
            							</li>
            						</ul>
            					</div>
            				</div><!--.tabs-section-nav-->




            				<div class="tab-content">
            					<div role="tabpanel" class="tab-pane fade in active" id="tabs-1-tab-1">
                        <form action="createpac.php" method="post">
                          <div class="form-group">
                            <label>Package Name</label>
                            <input type="text" class="form-control" placeholder="Enter Package Name" name="pckname">
                          </div>
                          <div class="form-group">
                            <label>Package Details</label>
                            <input type="textarea" class="form-control" placeholder="Intro of package" name="pckdetail">
                          </div>

    					  <div class="form-group">
                            <label>Package Price ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="pckprice" >
                          </div>
    					  <div class="form-group">
                            <label>Package Tax( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="pcktax" >
                          </div>
    					  <div class="form-group">
    					  <label>
                Select Currency : <br/>
    		  <select name="currency">
    		  <?php $query="SELECT id,name,code FROM  currency";


     $result = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($result))
    {
    	$id="$row[id]";
    	$curname="$row[name]";
    	$curcode="$row[code]";

      print "<option value='$curcode'>$curname - $curcode </option>";

      }
      ?>

    </select>
    </label>
    <br/>
     <div class="form-group">
                            <label>Minimum Payout For User ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="User should earn minimum this money to send payment request, Like 50 or 100 and should not be 0" name="pckmpay" >
                          </div>

    					   <div class="form-group">
                            <label>Signup Bonus( Only Number )</label>
                            <input type="text" class="form-control" placeholder="User will receive bonus amount after signup. Like 10,20 or 0 to disable" name="pcksbonus" >
                          </div>

    <div class="form-group">
                            <label>Level 1 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev1">
                          </div>
    					  <div class="form-group">
                            <label>Level 2 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev2">
                          </div>
    					  <div class="form-group">
                            <label>Level 3 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev3">
                          </div>
    					  <div class="form-group">
                            <label>Level 4 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev4">
                          </div>
    					  <div class="form-group">
                            <label>Level 5 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev5">
                          </div>
    					  <div class="form-group">
                            <label>Level 6 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev6">
                          </div>
    					  <div class="form-group">
                            <label>Level 7 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev7">
                          </div>
    					  <div class="form-group">
                           <label>Level 8 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev8">
                          </div>
    					  <div class="form-group">
                            <label>Level 9 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev9">
                          </div>
    					  <div class="form-group">
                            <label>Level 10 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev10">
                          </div>
    					  <div class="form-group">
                            <label>Level 11 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev11">
                          </div>
    					  <div class="form-group">
                            <label>Level 12 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev12">
                          </div>
    					  <div class="form-group">
                            <label>Level 13 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev13">
                          </div>
    					  <div class="form-group">
                           <label>Level 14 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev14">
                          </div>
    					  <div class="form-group">
                            <label>Level 15 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev15">
                          </div>
    					  <div class="form-group">
                           <label>Level 16 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev16">
                          </div>
    					  <div class="form-group">
                           <label>Level 17 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev17">
                          </div>
    					  <div class="form-group">
                            <label>Level 18 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev18">
                          </div>
    					  <div class="form-group">
                           <label>Level 19 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev19">
                          </div>

    					  <div class="form-group">
                           <label>Level 20 ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Like 10,20" name="lev20">
                          </div>
    					  <div class="form-group">
                           <label>Renew Day(s) ( Only Number )</label>
                            <input type="text" class="form-control" placeholder="Enter '99999' for no expiry or enter no of days like 30 (1 month), 60 (2 months), 365 (1 year) - This would be the expiry date for user account" name="renewdays">
                          </div>
    					  <div class="list-group-item">

    </div>



    </div>

                         <button type="submit" class="btn btn-rounded btn-inline">Create Package</button>
                        </form>
                      </div><!--.tab-pane-->



            					<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-2">
                        <form action="updatepck.php" method="post">
                        <div class="form-group">
                          <label>
              Select Package To Update/Edit :
  		  <select name="upackage">
  		  <?php $query="SELECT id,name,price,currency,tax FROM  packages";


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

                       <button type="submit" class="btn btn-rounded btn-inline">Update Package</button>
                      </form>
                      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
                      </div><!--.tab-pane-->


            					<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-3">
                        <form action="deletepackage.php" method="post">
                    		  <label>
                                Select Package To Delete :
                      		  <select name="packagedelid">
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
                          </label>
                          <button type="submit" class="btn btn-rounded btn-inline">Deactivate Package</button>
                  </form>
                      </div><!--.tab-pane-->



            				</div><!--.tab-content-->
            			</section><!--.tabs-section-->

          </section>
        </div>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
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
