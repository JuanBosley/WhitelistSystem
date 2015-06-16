<?php
include ('../includes/db_connect.php');

if(!isset($_SESSION['apaneluser']))
{
header('Location: login.php');
}

$enabled = "true";
if (isset($_GET['cmd']))
{
$command = $_GET['cmd'];
if ($command == "mass")
{
echo '<html><head>';
echo '<title>Server Commands | iCarey.net</title>';
echo '<meta http-equiv="content-type" content="text/html" />';
echo '<meta charset="utf-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
echo '<meta name="author" content="Ian Carey">';
echo '<meta name="description" content="iCarey.net Survival Minecraft Server">';
echo '<meta name="keywords" content="">';
echo '<link rel="shortcut icon" href="img/favicon.ico">';
echo '<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700" rel="stylesheet" "type=text/css">';
echo '<link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap Stylesheet -->';
echo '<link type="text/css" href="../css/minecraft.css" rel="stylesheet"/> <!-- Site Custom Stylesheet -->';
echo '<link type="text/css" href="../css/nether.css" rel="stylesheet"/> <!-- Custom Theme Stylesheet -->';
echo '<link type="text/css" href="../css/netherform.css" rel="stylesheet"/> <!-- Custom Theme Stylesheet -->';
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
echo '<div class="alert alert-warning" role="mailwarning">';
  echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
  echo '<span class="sr-only">Approved:</span>';
  echo '<strong>  Warning!</strong> After you press send, please wait a few minutes till all emails are sent!';
  echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
  echo '</div>';
echo '<h1 class="pagetitle">iCarey.net Mass Mail Sender</h1>';
echo '</div>';
echo '</div>';
echo '<div class="row">';
echo '<div class="col-md-8">';
echo '<fieldset class="well cmdfield">';
echo '<legend class="cmdlegend">Send Mass Mail</legend>';
echo '<form action="mail.php" method="post">';
echo '<center>';
echo '<input type="text" name="subject" placeholder="Please enter subject of the email."></input><br>';
echo '<textarea name="mailtext" ROWS=20 placeholder="Please enter the text of email, this email will be sent to all emails in your database. You can configure the text in functions.php file!"></textarea><br>';
echo '<input type="submit" name="submit" value="Send!"></input>';
echo '</center>';
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
}
if ($command == "view")
{
echo '<html><head>';
echo '<title>Server Commands | iCarey.net</title>';
echo '<meta http-equiv="content-type" content="text/html" />';
echo '<meta charset="utf-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
echo '<meta name="author" content="Ian Carey">';
echo '<meta name="description" content="iCarey.net Survival Minecraft Server">';
echo '<meta name="keywords" content="">';
echo '<link rel="shortcut icon" href="img/favicon.ico">';
echo '<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700" rel="stylesheet" "type=text/css">';
echo '<link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap Stylesheet -->';
echo '<link type="text/css" href="../css/minecraft.css" rel="stylesheet"/> <!-- Site Custom Stylesheet -->';
echo '<link type="text/css" href="../css/nether.css" rel="stylesheet"/> <!-- Custom Theme Stylesheet -->';
echo '<link type="text/css" href="../css/netherform.css" rel="stylesheet"/> <!-- Custom Theme Stylesheet -->';
echo '';
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
echo '<h1 class="pagetitle">iCarey.net User List</h1>';
echo '</div>';
echo '</div>';
echo '<div class="row">';
echo '<div class="col-md-8">';
echo '<fieldset class="well cmdfield">';
echo '<legend class="cmdlegend">Command Center</legend>';
echo '<table class="table">';
echo '<thead>';
echo '<tr>';
echo '<th>Username</th>';
echo '<th>Email</th>';
echo '<th>Age</th>';
echo '<th>Status</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
$select = "SELECT * FROM whitelist";
            $result = mysql_query($select);
            while ($row = mysql_fetch_assoc($result)){
			echo '<tr>';
			echo '<td>'.$row['username'].'</td>';
			echo '<td>'.$row['email'].'</td>';
			echo '<td>'.$row['age'].'</td>';
			if ($row['approved'] == "1")
			{
			echo '<td><font color="green">Approved</font></td>';
			}
			if ($row['approved'] == "2")
			{
			echo '<td><font color="red">Unapproved</font></td>';
			}
			if ($row['approved'] == "0")
			{
			echo '<td><font color="orange">Waiting</font></td>';
			}
			echo '</tr>';
			}
echo '</tbody>';
echo '</table>';
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
echo '</html>';}
}
if (isset($_POST['submit']))
{
$select = "SELECT email FROM whitelist WHERE approved='1'";
            $result = mysql_query($select);
            while ($row = mysql_fetch_assoc($result)){
			$email = $row['email'];
			SendMail($_POST['subject'], $email, $sendfrom, $_POST['mailtext']);
			}
			header('Location: index.php?notice=All emails were succesfully sent!');
}
function SendMail($subject1, $to, $from, $text)
{
$subject = $subject1;

// message
$message = $text;

//Send Mail using phpmailer

	$config = parse_ini_file('../includes/config.ini.php', 1, true);
    $mail             = new PHPMailer();
    $body             = $message;
    $mail->IsSMTP();
    $mail->Host       = $config['email']['host'];                 
    $mail->SMTPAuth   = true;
    $mail->Host       = $config['email']['host'];
    $mail->Port       = $config['email']['port'];
    $mail->Username   = $config['email']['username'];
    $mail->Password   = $config['email']['password'];
    $mail->SMTPSecure = 'tls';
    $mail->SetFrom($config['email']['from'], $config['email']['fromname']);
    $mail->AddReplyTo($config['email']['reply'], $config['email']['replyname']);
    $mail->Subject    = $subject;
    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
    $mail->MsgHTML($body);
    $address = $to;
    $mail->AddAddress($address, $name);
    if(!$mail->Send()) {
        return 0;
    } else {
            return 1;
    }
}
?>