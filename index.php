<?php
	require("db.php"); 
?>
<html>
	<head>
		<title>index</title>
	</head>
	<body>
		<h1>Online Forum</h1>
	<?php
		if(!isset($_SESSION["name"])){
			echo "<button onclick=window.location.assign('login.php')>Log In</button> ";
			echo "<button onclick=window.location.assign('register.php')>Register</button><br>";
		}else{
			$name= $_SESSION['name'];
			$query= "SELECT `user_id` FROM `user` WHERE `name`= '$name'";
			$user= $con->query($query)->fetch_assoc();
			echo "<button onclick=window.location.assign('user.php?user_id=".$user['user_id']."')>". $_SESSION['name']."</button> ";
			echo "<button onclick=window.location.assign('logout.php')>Logout</button><br>";
		}
	?>
	<br>
	<button onclick="window.location.assign('addques.php')">Add your Question</button>
	<br>
		<a href="category.php?category_id=1">Programming</a><br>
		<a href="category.php?category_id=2">Web Design</a><br>
		<a href="category.php?category_id=3">Graphics Design</a><br>
		<a href="category.php?category_id=4">Networking</a><br>
		<a href="category.php?category_id=5">Web Development</a><br>
		<a href="category.php?category_id=6">Robotics</a><br>
	</body>
</html>