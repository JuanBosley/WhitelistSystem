<?php
include ('../includes/db_connect.php');
$config = parse_ini_file('../includes/config.ini.php', 1, true);
include_once("../includes/rcon.php");
require_once('../phpmailer/PHPMailerAutoload.php');

function Deny($id, $wsip, $wspass, $wsport, $to, $enabled)
{
    global $dbh; $two = "2";
    $sql = "UPDATE whitelist SET approved=:two WHERE id=:id";
    $prep = $dbh->prepare($sql);
    $prep->bindparam(":id",$id,PDO::PARAM_INT);
    $prep->bindparam(":two",$two,PDO::PARAM_INT);
    $prep->execute();
    if($prep->rowcount() == "0")
    {
        die("<p>Error denying user. function_deny.php");
    }
    $sql = "SELECT * FROM whitelist WHERE id=:id";
    $prep = $dbh->prepare($sql);
    $prep->bindparam(":id",$id,PDO::PARAM_INT);
    $prep->execute();
    if($prep->rowcount() == "0")
    {
        die('<p>Error querying the database. function_deny.php</p>');
    }
    foreach($prep->fetchall() as $prep)
    {
        $userign = $row['username'];
		$email = $row['email'];
        $r = new rcon($wsip,$wsport,$wspass); //create rcon object for server on the rcon port with a specific password
    		if($r->Auth())
            { //Connect and attempt to authenticate
                $r->rconCommand("whitelist remove $userign"); //send a command
    			$r->rconCommand("whitelist reload"); //send a command
    			$r->rconCommand("say Removed $userign from whitelist!");//send a command
    		} //End $->auth
    }//End foreach

	if ($enabled == "true")
	{
        //if sendmail is enabled, send one.
	    Declined($to);
	}
}

function Declined($to)
{
    global $config;
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
    //Spacer
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