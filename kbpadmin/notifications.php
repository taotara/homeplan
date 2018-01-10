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
<title>Notifications Settings</title>
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
            <p><strong>Important Instructions </strong> <b>1.</b> All Details Are Mandatory. </p>
          <section class="box-typical box-typical-padding">
                  <header class="card-header card-header-lg"> Notifications Settings </header>


                  <section class="tabs-section">
            				<div class="tabs-section-nav tabs-section-nav-icons">
            					<div class="tbl">
            						<ul class="nav" role="tablist">
            							<li class="nav-item">
            								<a class="nav-link active" href="#tabs-1-tab-1" role="tab" data-toggle="tab">
            									<span class="nav-link-in">
            										<i class="glyphicon glyphicon-send"></i>
            										Post Notification
            									</span>
            								</a>
            							</li>
            							<li class="nav-item">
            								<a class="nav-link" href="#tabs-1-tab-2" role="tab" data-toggle="tab">
            									<span class="nav-link-in">
            										<span class="glyphicon glyphicon-remove"></span>
            										Delete Notification
            									</span>
            								</a>
            							</li>
            						</ul>
            					</div>
            				</div><!--.tabs-section-nav-->

            				<div class="tab-content">
            					<div role="tabpanel" class="tab-pane fade in active" id="tabs-1-tab-1">
                        <form class="form-group" action="postnoti.php" method="post">
                          <div class="form-group">
                            <label>Notifications Heading/Subject</label>
                            <input type="text" class="form-control" placeholder="Maximum 20 Words" name="notihead">
                          </div>
                          <div class="form-group">
                            <label>Notification Body</label><br/>
                           <textarea rows="4" cols="90" class="form-control" name="notibody">Details of the notifications</textarea>
                          </div>
                         <button type="submit" class="btn btn-rounded">Post Notification To All Users</button>
                        </form>
                      </div><!--.tab-pane-->
            					<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-2">
                        <form class="form-group" action="deletenoti.php" method="post">
                      <div class="form-group">
                        <label>
            Select Notification Id To Deactivate/Delete :
		  <select name="notisub">
		  <?php $query="SELECT id,subject,posteddate FROM  notifications where valid=1";


 $result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
	$id="$row[id]";
	$notisubj="$row[subject]";
	$notidate="$row[posteddate]";


  print "<option value='$id'>$notisubj | Dated - $notidate </option>";

  }
  ?>

</select>
                      </div>
                     <button type="submit" class="btn btn-rounded">Delete Notification</button>
                    </form>
                      </div><!--.tab-pane-->
            				</div><!--.tab-content-->
            			</section><!--.tabs-section-->
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
