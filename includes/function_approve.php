<?php
include ('db_connect.php');
$config = parse_ini_file('config.ini.php', 1, true);
include_once("rcon.php");
require_once('../phpmailer/PHPMailerAutoload.php');

function Approve($id, $wsip, $wspass, $wsport, $to, $enabled)
{
    global $dbh; global $config; $one = "1";
    //Approve the user in the DB (update)
    $sql = "UPDATE whitelist SET approved=:one WHERE id=:id";
    $prep = $dbh->prepare($sql);
    $prep->bindparam(":one",$one,PDO::PARAM_INT);
    $prep->bindparam(":id",$id,PDO::PARAM_INT);
    $prep->execute();
    if($prep->rowcount() == "0")
    {
        die("<p>Error! function_approve.php - Tried to update the user.");
    }
    //Get their username from ID.
    $sql = "SELECT * FROM whitelist WHERE id=:id";
    $prep = $dbh->prepare($sql);
    $prep->bindparam(":id",$id,PDO::PARAM_INT);
    $prep->execute();
    if($prep->rowcount() =="0")
    {
    	die("<p>Error! function_approve.php - Tried to get their username.</p>");
    }
    foreach($prep->fetchall() as $res)
    {
    	$userign = $res['username'];
    	$email = $res['email'];
        $r = new rcon($wsip,$wsport,$wspass); //create rcon object for server on the rcon port with a specific password
		if($r->Auth())
		{ //Connect and attempt to authenticate
			$r->rconCommand("whitelist add $userign"); //send a command
			$r->rconCommand("whitelist reload"); //send a command
			$r->rconCommand("say Added $userign to whitelist!");
		}
		if($enabled == "true")
		{
			//If emails are enabled - Send one.
			Accepted($to);
		}
	}
}
function Accepted($to)
{
	global $config;
	//Because the user is accepted - Email them.
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
	$mail = new PHPMailer();
	$body = $message;
	$mail->IsSMTP();
	$mail->Host = $config['email']['host'];                 
	$mail->SMTPAuth = true;
	$mail->Host = $config['email']['host'];
	$mail->Port = $config['email']['port'];
	$mail->Username = $config['email']['username'];
	$mail->Password = $config['email']['password'];
	$mail->SMTPSecure = 'tls';
	$mail->SetFrom($config['email']['from'], $config['email']['fromname']);
	$mail->AddReplyTo($config['email']['reply'], $config['email']['replyname']);
	$mail->Subject = $subject;
	$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
	$mail->MsgHTML($body);
	$address = $to;
	$mail->AddAddress($address, $name);
	if(!$mail->Send()) 
	{
		return 0;
	}
	else
	{
		return 1;
	}
}

?>