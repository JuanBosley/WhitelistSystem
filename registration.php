<?php
//User has submitted whitelist.php - This gets called
//Lazy form validation
foreach($_POST as $p=>$v)
{
	//Lazy field validation - Cycle all fields. versus multiple IF's.
	if(empty($p))
	{
		die('<p><a href="whitelist.php">Please go back and fill in all fields.</a></p>');
	}
}
//End lazy form validation

include ('includes/db_connect.php');
$config = parse_ini_file('includes/config.ini.php', 1, true);
require_once('phpmailer/PHPMailerAutoload.php');
require_once('includes/function_mail.php');
$captcha;
$bool_sendmail = $config['minecraft']['sendmail'];

/*
Disabled for now - Not because it doesn't work, but effort just to get a KEY.
Not worth it during devving and testing

if(isset($_POST['g-recaptcha-response']))
{
  $captcha=$_POST['g-recaptcha-response'];
}
else
{
  die('<h2>Please check the the captcha form.</h2>');
}
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=SECRETKEYHERE&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
if($response.success==false)
{
  echo '<h2>You are spammer ! Get the @$%K out</h2>';
  die();
}
*/

//Params for the DB
$username=htmlentities($_POST['username']); //Found out that whilst PDO is SQLi proof- It's not XSS proof.
$email=htmlentities($_POST['email']); //Don't worry we'll use htmlentities_decode later
$age=htmlentities($_POST['age']);
$comment=htmlentities($_POST['comment']);
$approved = "0";
//End params for the DB

//Begin email construction

//Notification EMAIL Message
$address = "mcadmins@icarey.net";  //Address to send new register notifications to.
$subject = "iCarey.net Whitelist New Registration"; //SUBJECT

//Message in HTML format.
$message = "Admins, <br>";
$message .= "There has been a new whitelist application submitted!<br>";
$message .= "<h4>Please visit https://mc.icarey.net/whitelist to review application.</h4><br>";
$message .= "There is also a copy of the user's application attached at the end of this message.<br>";
$message .= "<br>";
$message .= "Thank You, <br> Smashedbotatos<br>";
$message .= "<br>";
$message .= "<Strong> User Information:</strong>";
$message .= "<hr>";
$message .= "Minecraft User - $username<br>";
$message .= "Email - $email<br>";
$message .= "Age - $age<br>";
$message .= "Description - $comment<hr>";
//End email construction

//Begin inserting into the DB

//We should already be connected to DB via PDO - Otherwise it should've thrown an error by now
$sql = "INSERT INTO whitelist (username, age, email, comment, approved) VALUES (:username,:age,:email,:comment,:approved)";
$prep = $dbh->prepare($sql); //prepare PDO
//prep the strings/ints
$prep->bindparam(":username",$username,PDO::PARAM_STR);
$prep->bindparam(":age",$age,PDO::PARAM_INT);
$prep->bindparam(":email",$email,PDO::PARAM_STR);
$prep->bindparam(":comment",$comment,PDO::PARAM_STR);
$prep->bindparam(":approved",$approved,PDO::PARAM_INT); //[1] 
$prep->execute();
//End inserting into the DB

//Begin checking if record was inserted
$c = $prep->rowcount(); //Check if the query was successfull or not - 1 = yes, 0 = no
if($c == "1")
{
	//Success
	if($bool_sendmail == "true")
	{
		SendMailNotification($message,$subject,$address);
		echo "<p>Success! Your application will be processed shortly.</p>";
	}
	else
	{
		echo "<p>Success! Your Application will be processed shortly.</p>";
	}
}
//End insertion check
	
?>
