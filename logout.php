<?php
	require("db.php");
	unset($_SESSION['name']);
	session_destroy();
	header("Location: index.php");

?>