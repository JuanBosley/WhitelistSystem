<?php
include ('../includes/db_connect.php');
$config = parse_ini_file('../includes/config.ini.php', 1, true);
if(isset($_POST['submit']))
{
    if ($_POST['apaneluser'] == $config['minecraft']['apaneluser'] && $_POST['apanelpass'] == $config['minecraft']['apanelpass'])
    {
        $_SESSION['apaneluser'] = $config['minecraft']['apaneluser'];
        header('Location: index.php');
    }
    else
    {
        echo "Wrong account credentials!\n";
        header('Location: login.php');
    }
}
else
{
?>

<!DOCTYPE html>
<html lang='en'>

	<head>
		 
		<title>Whitelist Admin Portal | iCarey.net</title>
		<meta http-equiv="content-type" content="text/html" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Ian Carey">
		<meta name="description" content="iCarey.net Survival Minecraft Server">
		<meta name="keywords" content="">
		
		<!-- Favicon 
		============================================= -->
		<link rel="shortcut icon" href="img/favicon.ico">
		
		<!-- Fonts 
		============================================= -->
		<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700' rel='stylesheet' type='text/css'>
		
		<!-- Stylesheets 
		============================================= -->
		<link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap Stylesheet -->
		<link type="text/css" href="../css/minecraft.css" rel="stylesheet"/> <!-- Site Custom Stylesheet -->
		<link type="text/css" href="../css/nether.css" rel="stylesheet"/> <!-- Custom Theme Stylesheet --> 
		<link type="text/css" href="../css/netherform.css" rel="stylesheet"/> <!-- Custom Form Theme Stylesheet -->
		
		<!-- Scripts 
		============================================= -->
		
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		
	</head>
<body>
<header role="banner">
  <img id="logo-main" src="../img/logo.png" width="200" alt="Logo Thing main logo">
</header><!-- header role="banner" -->

<!-- Navigation -->
<div class="container">
	<nav id="navbar-primary" class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-primary-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		</div>
		<div class="collapse navbar-collapse nav-pills" id="navbar-primary-collapse">
		<ul class="nav navbar-nav">
			<li><a href="https://mc.icarey.net">Home</a></li>
			<li><a href="#">Guide</a></li>
			<li><a href="../map">Map</a></li>
			<li><a href="../stats">Stats</a></li>
			<li class="active"><a href="whitelist/login.php">Admin Panel</a></li>	
			<li><a href="#">Contact</a></li>

		</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
</div> <!-- /Nav Container -->

<!-- Page Content -->
<div class="container">
<div class="row">
		<div class="col-md-12">
			<h1 class="pagetitle">iCarey.net Whitelist AdminPanel Login</h1>
		</div>
</div>
	<div class="row">
<!-- Login Form -->
		<div style="text-align:center" class="col-md-12">
			<form class="loginform" id="loginform" action="login.php" method="post">
				<h1 class="formtitle">Whitelist Login Portal</h1>	
				<label class="formlabel" style="margin-top:100px" for="username">Username</label>
				<input class="forminput" type="text" name="apaneluser" id="apaneluser"></input>
				<label class="formlabel" for="password">Password</label>
				<input class="forminput" type="password" name="apanelpass" id="apanelpass"></input><br>
				<input class="formbutton" style="margin-top: 95px;" type="submit" name="submit" id="submit" value="Login"></input>
			</form>
		</div>
	</div>
	<div id="footer" class="">
		<div class="container">
			<p>iCarey.net &copy;2010-2015 - All rights reserved<a href="https://www.icarey.net" class=""> iCarey.net</a></p>
		</div>
	</div>
</div>
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>

<?php
}
?>