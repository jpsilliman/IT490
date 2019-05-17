<?php

function connection(){

	$hostname = '192.168.3.31'
	$username = 'kyl293'
	$password = '1234'
	$dbname = 'it490'

	$db = mysqli_connect ( $hostname, $username, $password, $dbname );

	if (!db)
	{
		echo "Failed to connect to MYSQL<br><br> ". $db->mysqli_connect_error.PHP_EOL;
		exit(1);
	}
	echo "Successfully connected to MySQL<br><br>";
	return $db;

}
?>
