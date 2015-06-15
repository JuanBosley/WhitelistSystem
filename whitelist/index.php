
<?php
include ('../includes/db_connect.php');
$config = parse_ini_file('../includes/config.ini.php', 1, true);
include ('functions.php');

if(isset($_SESSION['apaneluser']))
{
    header('Content-type: text/html; charset=UTF-8');
}
else
{
    header('Location: login.php');
}
?>


<!DOCTYPE html>
<html lang='en'>

	<head>
		 
		<title>Whitelist Registration | iCarey.net</title>
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
		<link type="text/css" href="../css/netherform.css" rel="stylesheet"/> <!-- Custom Form Stylesheet -->
		
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
			<li class="active"><a href="index.php">Home</a></li>
			<li><a href="approved.php">Approved</a></li>
			<li><a href="unapproved.php">Unapproved</a></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">RCON Commands <span class="caret"></span></a>
				<ul class="dropdown-menu" role="RCON-menu">
					<li><a href="command.php?cmd=reload">Reload Server</a></li>
					<li><a href="command.php?cmd=whitelist reload">Reload Whitelist</a></li>
					<li><a href="command.php?cmd=save-all">Save World</a></li>
					<li><a href="command.php?cmd=custom">Custom Command</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Users <span class="caret"></span></a>
				<ul class="dropdown-menu" role="Users-menu">
					<li><a href="mail.php?cmd=view">User List</a></li>
					<li><a href="mail.php?cmd=mass">Mail All Users</a></li>
				</ul>
			</li>		
			<li><a href="logout.php">Logout</a></li>

		</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
</div> <!-- /Nav Container -->

<!-- Page Content -->
<div class="container">
	
		
<?php
if (isset($_GET['notice']))
{
  $notice =  htmlentities($_GET['notice']);
  echo '<div class="alert alert-success" role="alertsucess">';
  echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ';
  echo '<span class="sr-only">Error:</span>';
  echo '' .$notice. '';
  echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
  echo '</div>';
}
        if (isset($_GET['approved']))
        {
            $res = htmlentities($_GET['approved']);
            $id = htmlentities($_GET['id']);
			$mail = htmlentities($_GET['email']);
			$user = htmlentities($_GET['userign']);
            if ($res == "1")
            {
                Approve($id, $config['minecraft']['ip'], $config['minecraft']['rpass'], $config['minecraft']['rport'], $mail, $config['minecraft']['sendmail']);
                echo '<div class="alert alert-success" role="regaccept">';
  echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
  echo '<span class="sr-only">Approved:</span>';
  echo '<strong>  Approved!</strong> Added User: ' . $user . ' with ID: ' . $id . ' to the server whitelist!';
  echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
  echo '</div>';
            }
            if ($res == "2")
            {
                Deny($id, $config['minecraft']['ip'], $config['minecraft']['rpass'], $config['minecraft']['rport'], $mail, $config['minecraft']['sendmail']);
				echo '<div class="alert alert-danger" role="regremove">';
				echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
				echo '<span class="sr-only">Removed:</span>';
                echo '<strong>  Denied!</strong> Removed User: ' . $user . ' with ID: ' . $id . ' from the server whitelist!';
  echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
  echo '</div>';
            }
        }
        if ($dbh)
        {
        	//Left blank - Will let you continue with this.

        }
        else
        {
            echo '<div class="alert alert-warning" role="dbwarning">';
				echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
				echo '<span class="sr-only">Warning:</span>';
				echo '<strong>  Warning!</strong> Could not connect to database!';
  echo '<a href="#close" class="icon-remove"></a>';
  echo '</div>';
        }
?>
<div class="row">
		<div class="col-md-12">
			<h1 class="pagetitle">iCarey.net Whitelist Registration</h1>
		</div>
	</div>
	<div class="row">
<!-- Waiting User List Column -->
		<div class="col-md-12">

<?php
			//Convert to PDO
			$zero = "0";
            $select = "SELECT * FROM whitelist WHERE approved=:zero";
            $prep = $dbh->prepare($select);
            $prep->bindparam(":zero",$zero,PDO::PARAM_INT);
            $prep->execute();
            $c = $prep->rowcount();
            if($c == "0")
            {
            	echo '<div class="well">';
            	echo "No applications found";//Might want to put this in a proper <div>
            	echo '</div>';
            }
            
            foreach($prep->fetchall() as $row)
            {
            	echo '<div class="well">';
            	$userid = $row['id'];
				$userign = $row['username'];
	            $comment = $row['comment'];
	            $email = $row['email'];
	            $text = $comment;
	            echo '<table class="table">';
				echo '<thead> <tr> <th>Username</th><th>Age</th><th>Email</th><th>Reddit!</th></tr></thead>';
				echo '<tbody> <tr> <td>' . $row['username'] . '</td><td>' . $row['age'] . '</td><td>' . $row['email'] . '</td><td>' . $row['reddit'] . '</td></tr> </tbody>';
				echo '</table>';
				echo '<div class="well">' . $text . '</div>';
				echo '<center><a href="index.php?approved=1&id='.$userid.'&email='.$email.'&userign='.$userign.'"><button class="btn-success">Approve</button></a>    <a href="index.php"><button class="btn-warning">Check Bans</button></a><a href="index.php?approved=2&id='.$userid.'&email='.$email.'"><button class="btn-danger">Decline</button></a><center>';
				echo '</div>';
            }
?>	
	</div>
	</div>
<div id="footer" class="">
    <div class="container">
        <p>iCarey.net &copy;2010-2015 - All rights reserved<a href="https://www.icarey.net" class=""> iCarey.net</a>
        </p>
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