<?php
/*
Psuedo bans
Cheap and dirty caching system: Save each query to file, load to file if is < 6 hours old.
http://fishbans.com/docs.php

###This is psuedo/mock up - No where remotely the final version.###
###This is dirty, messy, probably buggy as hell###
*/

//Check if the folder bans_cache exists - If not, create it.
if(!file_exists('bans_cache'))
{
	//Folder doesn't exist - Try and make it.
	if(!mkdir("bans_cache",0644))
	{
		die('<p>Error creating bans cache folder. Please manually create it with 0644</p>');
	}
	else
	{
		echo header("location:test.php");
	}
}
$bans_cache = "bans_cache\\"; // Pull from config later
//Ok bans_cache exists. Lets process the query.
$banfish_url = "http://api.fishbans.com/bans/"; //Incase the URL changes along the way.
$username = "fcb2009";//_GET/_POST
if(file_exists("$bans_cache"."$username.json"))
{
	//echo '<h2>File exists</h2>';
	$open_it = file_get_contents("$bans_cache"."$username.json");
	$decode_it = json_decode($open_it,true);
	array_walk_recursive($decode_it['bans'], 'DisplayBanReport');
}
else
{
	//File doesn't exist.
	$request_it = file_get_contents($banfish_url.$username);
	echo $banfish_url.$username;
	$cache_it = file_put_contents("$bans_cache"."$username.json", $request_it);
	//Ok figure out without refresh, to load and walk the array, because it's not finding the file w/o refreshing...
}

function DisplayBanReport($item,$key)
{
	echo '<p>'.ucfirst($key).': '.$item.'</p>';
}
/*

//Cache the file


var_dump($JSON);
echo "<h2>Bans:</h2>";

array_walk_recursive($JSON['bans'], 'test_print'); //Cycle through the entire array. 
//Foreach isn't sufficient with the array in an array, in an array ... that Fishbans provides.
*/
?>
