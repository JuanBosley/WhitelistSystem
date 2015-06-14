<?php
include ('includes/db_connect.php');
$config = parse_ini_file('includes/config.ini.php', 1, true);
require_once('phpmailer/PHPMailerAutoload.php');
require_once('includes/function_mail.php');
$captcha;
$bool_sendmail = $config['minecraft']['sendmail'];

if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
        
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=SECRETKEYHERE&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h2>You are spammer ! Get the @$%K out</h2>';
          die();
        }
$username=$_POST['username'];
$email=$_POST['email'];
$age=$_POST['age'];
$comment=$_POST['comment'];
$approved = "0";

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
//END Notification EMAIL Message
		
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
$c = count($prep->rowcount()); //Check if the query was successfull or not - 1 = yes, 0 = no
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
	
?>