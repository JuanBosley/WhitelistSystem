<?php
include ('../includes/db_connect.php');
$config = parse_ini_file('../includes/config.ini.php', 1, true);
include_once("rcon.php");
require_once('../phpmailer/PHPMailerAutoload.php');

/*
Why do we need duplicates in index.php and below?
$zero = "0";
$query = "SELECT * from whitelist WHERE approved=:zero";
$prep = $dbh->prepare($query);
$prep->bindparam(":zero", $zero,PDO::PARAM_INT);
$prep->execute();
$c = count($prep->fetchall());
if($c > "0")
{
    
}
*/
function Approve($id, $wsip, $wspass, $wsport, $to, $enabled)
{
    global $dbh; $one = "1";
    $sql = "UPDATE whitelist SET approved=:one WHERE id=:id";
    $prep = $dbh->prep($sql);
    $prep->bindparam(":one",$one,PDO::PARAM_INT);
    $prep->bindparam(":id",$id,PDO::PARAM_INT);
    $prep->execute();
    if($prep->rowcount() == "0")
    {
        die("<p>Error! Functions.php Line 30");
    }
    $username = mysql_query("SELECT * FROM whitelist WHERE id='$id'");
    while ($row = mysql_fetch_assoc($username)){
        $userign = $row['username'];
		$email = $row['email'];
        $r = new rcon($wsip,$wsport,$wspass); //create rcon object for server on the rcon port with a specific password
		if($r->Auth()){ //Connect and attempt to authenticate
		{
			$r->rconCommand("whitelist add $userign"); //send a command
			$r->rconCommand("whitelist reload"); //send a command
			$r->rconCommand("say Added $userign to whitelist!");
		}
		}
    }
	if ($enabled == "true")
	{
	    Accepted($to);
	}
	
}
function Deny($id, $wsip, $wspass, $wsport, $to, $enabled)
{
    mysql_query("UPDATE whitelist SET approved=2 WHERE id='$id'");
    $nick = mysql_query("SELECT * FROM whitelist WHERE id='$id'");
    while ($row = mysql_fetch_assoc($username)){
        $userign = $row['username'];
		$email = $row['email'];
        $r = new rcon($wsip,$wsport,$wspass); //create rcon object for server on the rcon port with a specific password
		if($r->Auth()){ //Connect and attempt to authenticate
		{
			$r->rconCommand("whitelist remove $userign"); //send a command
			$r->rconCommand("whitelist reload"); //send a command
			$r->rconCommand("say Removed $userign from whitelist!");//send a command
		}
		}
    }
	if ($enabled == "true")
	{
	    Declined($to);
	}
}
function Accepted($to)
{
//subject
$subject = 'iCarey.net Whitelist Application';

// message
$message = "You have been <strong>Approved</strong> and added to the our whitelist.<br>";
$message .= "Welcome to the community!<br><strong>Connection Information:</strong>";
$message .= "<hr>";
$message .= "<strong>Address:</strong> mc.icarey.net";
$message .= "<strong>Dynmap:</strong> mc.icarey.net/map";
$message .= "<strong>Teamspeak:</strong> ts.icarey.net";
$message .= "<strong>SubReddit!:</strong> /r/iCareyMinecraft";
$message .= "<br>";
$message .= "Thank You for your Registration,";
$message .= "Smashedbotatos";
$message .= "https://mc.icarey.net";


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
function Declined($to)
{
//subject
$subject = 'iCarey.net Whitelist Application';

// message
$message = "We Apologize, you have been <strong>denied</strong> from joining our whitelist.<br>";
$message .= "You can resubmit your application, or contact the server admins.<br><strong>Contact Information:</strong>";
$message .= "<hr>";
$message .= "<strong>Email:</strong> mcadmins@icarey.net";
$message .= "<strong>Whitelist Application:</strong> https://mc.icarey.net/?page_id=28";
$message .= "<strong>SubReddit!:</strong> /r/iCareyMinecraft";
$message .= "<br>";
$message .= "Thank You for your Registration,";
$message .= "Smashedbotatos";
$message .= "https://mc.icarey.net";


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
