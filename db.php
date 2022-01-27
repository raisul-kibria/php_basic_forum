<?php
	$con = mysqli_connect("localhost","root","");
	mysqli_select_db($con, "Forum");
	mysqli_set_charset($con, 'utf8');
	if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	session_start();
	if(!isset($_SESSION["name"])){
		session_destroy();
	}
?>