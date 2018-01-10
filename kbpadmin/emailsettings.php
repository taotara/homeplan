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

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todoemail']))
{

$suemail=mysqli_real_escape_string($con,$_POST['signuptextarea']);
$fpemail=mysqli_real_escape_string($con,$_POST['forgottextarea']);


$status = "OK";
$msg="";

if ( $suemail=="" ){
$msg=$msg."Email content can not be empty.<BR>";
$status= "NOTOK";}

if ( $fpemail=="" ){
$msg=$msg."Email content can not be empty.<BR>";
$status= "NOTOK";}

if ($status=="OK")
{
$query1=mysqli_query($con,"update emailtext set etext='$suemail' where code='SIGNUP'");
$query2=mysqli_query($con,"update emailtext set etext='$fpemail' where code='FORGOTPASSWORD'");
$errormsg= "
<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Bingo!</br></strong>Youe E-Mail settings Have Been Updated.</div>"; //printing error if found in validation

}

else
{
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>".$msg."</div>"; //printing error if found in validation

}





}


?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>Email Configuration</title>
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
            <p><strong>Important Instructions </strong> <b>1.</b> All Details Are Mandatory. <b>2. </b>Please write email body to be sent in email during events. <b>3.</b></p>
          <section class="box-typical box-typical-padding">
                  <header class="card-header card-header-lg"> General Settings </header>
                  <div class="card-block">
                      <?php
            					  $query="SELECT * FROM  emailtext WHERE code='SIGNUP'";
                         $result = mysqli_query($con,$query);
                        $i=0;
                        while($row = mysqli_fetch_array($result))
                          {
                        	   $signupetext="$row[etext]";
                        	}

					            ?>
                  <div class="row">
                    <form class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
                      <input type="hidden" name="todoemail" value="post">
          					    <?php
              						if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errormsg!=""))
                						{
                						  print $errormsg;
                						}
          						  ?>
					              <div class="form-group">
                            <label>Sign Up E-Mail Body</label>
                            <textarea class="form-control" rows="6" data-minwords="6" data-required="true" placeholder="Type your message" name="signuptextarea"><?php print $signupetext;?></textarea>
                        </div>
          						   <?php
                					  $query="SELECT * FROM  emailtext WHERE code='FORGOTPASSWORD'";
                            $result = mysqli_query($con,$query);
                            $i=0;
                            while($row = mysqli_fetch_array($result))
                              {
                            	   $forgottext="$row[etext]";
                            	}
          					    ?>
						   
						  <div class="form-group">
                            <label>Forgot Password Request E-Mail Body</label>
                            <textarea class="form-control" rows="6" data-minwords="6" data-required="true" placeholder="Type your message" name=forgottextarea><?php print $forgottext;?></textarea>
                          </div>

                     <button type="submit" class="btn btn-rounded btn-inline">Update</button>
                    </form>
                  </div>
                </div>
    </div>
    </div>
</section>
<script src="../js/lib/jquery/jquery.min.js"></script>
<script src="../js/lib/tether/tether.min.js"></script>
<script src="../js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../js/plugins.js"></script>

<script src="../js/app.js"></script>
</body>
</html>
