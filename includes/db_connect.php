<?php
/**
 * Created by Smashedbotatos | iCarey.net
 * https://www.icarey.net/minecraft
 */
$config = parse_ini_file('config.ini.php', 1, true);
@session_start();

$host=$config['mysql']['host'];
$user=$config['mysql']['user'];
$pass=$config['mysql']['password'];
$db=$config['mysql']['database'];

//Implement PDO - This gives users options between MySQL, MySQLi ... 
$dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
if(!$dbh)
{
	die('Unable to connect to DB');
}
?>
