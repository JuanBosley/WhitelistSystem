<?php
function SendMailNotification($message,$subject,$address)
{
	//EMAIL SETUP	
	$config = parse_ini_file('config.ini.php', 1, true);
	$mail             = new PHPMailer();
	$body             = $message;
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = $config['email']['host']; // SMTP server
	$mail->SMTPDebug  = 0;                 // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
    $mail->SMTPAuth   = true;              // enable SMTP authentication
	$mail->Host       = $config['email']['host']; // sets the SMTP server
	$mail->Port       = $config['email']['port'];                    // set the SMTP port for the server
	$mail->Username   = $config['email']['username']; // SMTP account username
	$mail->Password   = $config['email']['password'];        // SMTP account password
	
	$mail->SetFrom($config['email']['from'], $config['email']['fromname']); //FROM
	
	$mail->AddReplyTo($config['email']['reply'], $config['email']['replyname']); //REPLY TO
	
	$mail->Subject    = $subject;
	
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, Alternate Body for those who can't view HTML mail.
	
	$mail->MsgHTML($body);
	
	$mail->AddAddress($address, "McAdmins"); 
		if(!$mail->Send()) 
		{
			echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		else 
		{
		  echo '<script type="text/javascript">window.alert("Thanks for your registration! Your registration will be reviewed soon."); window.location.href = "https://mc.icarey.net"</script>';  //Edit this address to your website
		}
	//END Email SEND
}
?>