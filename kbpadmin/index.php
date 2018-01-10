<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>Homeplan</title>
<link href="../images/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
<link href="../images/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
<link href="../images/favicon.png" rel="icon" type="image/png">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="../css/separate/pages/login.min.css">
<link rel="stylesheet" href="../css/lib/font-awesome/font-awesome.min.css">
<link rel="stylesheet" href="../css/lib/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="../css/main.source.css">

</head>
<body>
<div class="page-center">
    <div class="page-center-in">
        <div class="container-fluid">
            <form class="sign-box" action="loginproc.php" method="post">
                <div class="sign-avatar">
                    <img src="../images/logo2.png" alt="">
                </div>
                <header class="sign-title">Admin Login</header>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username"/>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                </div>
                <div class="form-group">
                    <div class="checkbox float-left">
                        <!--<input type="checkbox" id="signed-in"/>
                        <label for="signed-in">Keep me signed in</label>-->
                    </div>
                    <div class="float-right reset">
                        <a href="forgotpassword.php">Forgot password?</a>
                    </div>
                </div>
                <button type="submit" class="btn btn-rounded">Sign in</button>

            </form>
            <footer id="footer">
              <div class="text-center padder">
                <p> <small>Copyrights © 2017 KBHomeplan</small> </p>
              </div>
            </footer>
        </div>

    </div>
</div>
<script src="../js/lib/jquery/jquery.min.js"></script>
<script src="../js/lib/tether/tether.min.js"></script>
<script src="../js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../js/plugins.js"></script>
    <script type="text/javascript" src="../js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="../js/app.js"></script>
</body>
</html>
