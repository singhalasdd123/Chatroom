<?php
	$user="root";
	$pass="";
	$host="localhost";
	$con = mysqli_connect($host,$user,$pass,"chatroom");
	if(!$con)
	{
		die('Could not connect:'.mysql_error());
	}
	mysqli_select_db($con,"chatroom");
	$dsn='mysql:dbname=chatroom;host=127.0.0.1';
	$dbh = new PDO($dsn,$user,$pass);
?>
