<?php
include ('../includes/db_connect.php');
$config = parse_ini_file('../includes/config.ini.php', 1, true);
include_once("../includes/rcon.php");

if(isset($_SESSION['apaneluser']))
{
    header('Content-type: text/html; charset=UTF-8');
}
else
{
    header('Location: login.php');
}
if (isset($_GET['cmd']))
{
	if ($_GET['cmd'] != "custom")
	{
		$command = $_GET['cmd'];
		$r = new rcon($config['minecraft']['ip'], $config['minecraft']['rport'], $config['minecraft']['rpass']); //create rcon object for server on the rcon port with a specific password
		if($r->Auth())
		{ //Connect and attempt to authenticate
			$r->rconCommand("$command"); //send a command
		}
		header('Location: index.php?notice=Command executed successfully!');
	}	
	
	if($_GET['cmd'] == "custom")
	{
		echo '<html><head>';
		echo '<title>Server Commands |'.$config['website']['website_name'].'</title>';
		echo '<meta http-equiv="content-type" content="text/html" />';
		echo '<meta charset="utf-8">';
		echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
		echo '<meta name="author" content="Ian Carey">';
		echo '<meta name="description" content="$config["website"]["website_name"] Survival Minecraft Server">';
		echo '<meta name="keywords" content="">';
		echo '<link rel="shortcut icon" href="img/favicon.ico">';
		echo '<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700" rel="stylesheet" "type=text/css">';
		echo '<link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap Stylesheet -->';
		echo '<link type="text/css" href="../css/minecraft.css" rel="stylesheet"/> <!-- Site Custom Stylesheet -->';
		echo '<link type="text/css" href="../css/nether.css" rel="stylesheet"/> <!-- Custom Theme Stylesheet -->';
		echo '<link type="text/css" href="../css/netherform.css" rel="stylesheet"/> <!-- Custom Form Theme Stylesheet -->';
		echo '</head><body>';
		echo '<header role="banner"><img id="logo-main" src="../img/logo.png" width="200" alt="Logo Thing main logo"></header><!-- header role="banner" -->';
		echo '<div class="container">';
		echo '<nav id="navbar-primary" class="navbar navbar-default" role="navigation">';
		echo '<div class="container-fluid">';
		echo '<div class="navbar-header">';
		echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-primary-collapse">';
		echo '<span class="sr-only">Toggle navigation</span>';
		echo '<span class="icon-bar"></span>';
		echo '<span class="icon-bar"></span>';
		echo '<span class="icon-bar"></span>';
		echo '</button></div>';
		echo '<div class="collapse navbar-collapse nav-pills" id="navbar-primary-collapse">';
		echo '<ul class="nav navbar-nav">';
		echo '<li><a href="index.php">Home</a></li>';
		echo '<li><a href="approved.php">Approved</a></li>';
		echo '<li><a href="unapproved.php">Unapproved</a></li>';
		echo '<li><a href="logout.php">Logout</a></li>';
		echo '</ul>';
		echo '</div><!-- /.navbar-collapse -->';
		echo '</div><!-- /.container-fluid -->';
		echo '</nav>';
		echo '</div> <!-- /Nav Container -->';
		echo '<!-- Page Content -->';
		echo '<div class="container">';
		echo '<div class="row">';
		echo '<div class="col-md-8">';
		echo '<h1 class="pagetitle">'.$config['website']['website_name'].' Server Command Center</h1>';
		echo '</div>';
		echo '</div>';
		echo '<div class="row">';
		echo '<div class="col-md-8">';
		echo '<fieldset class="well cmdfield">';
		echo '<legend class="cmdlegend">Command Center</legend>';
		echo '<form class="vertical" action="command.php" method="get">';
		echo '<input type="text" placeholder="Enter the command without /" name="cmd"></input>';
		echo '<input type="submit" value="Send Command"></input>';
		echo '</form>';
		echo '</fieldset>';
		echo '</div>';
		echo '<div class="col-md-4">';
		echo '<div class="well">';
		echo '<h4> Side Stuff </h4>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '<div id="footer" class="">';
		echo '<div class="container">';
		echo '<p>iCarey.net &copy;2010-2015 - All rights reserved<a href="https://www.icarey.net" class=""> iCarey.net</a></p>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</body>';
		echo '</html>';
	}//End if custom
}
?>