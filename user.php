<?php
		require("db.php");
		$user= htmlspecialchars($_GET["user_id"]);
		$row= $con->query("SELECT * FROM `user` WHERE `user_id`= $user")->fetch_assoc();
?>
<!DOCTYPE html>
<head>
	<title>
		<?php
			echo $row['name'];
		?>
	</title>
</head>
<body>
			<a href="index.php"><h1>Online Forum</h1></a><br>
	<?php
		if(!isset($_SESSION["name"])){
			echo "<button onclick=window.location.assign('login.php')>Log In</button> ";
			echo "<button onclick=window.location.assign('register.php')>Register</button><br>";
		}else{
			$name= $_SESSION['name'];
			$query= "SELECT `user_id` FROM `user` WHERE `name`= '$name'";
			$luser= $con->query($query)->fetch_assoc();
			echo "<button onclick=window.location.assign('user.php?user_id=".$luser['user_id']."')>". $_SESSION['name']."</button> ";
			echo "<button onclick=window.location.assign('logout.php')>Logout</button><br><br>";
		}
	?>
	<br>
	<button onclick="window.location.assign('addques.php')">Add your Question</button>
	<br>
	<?php
		echo "<h1>". $row['name']."</h1><br>".
			 "<h3>". "Joined Date: ". $row['date']. "</h3><br>";

		$query= "SELECT * FROM `question` WHERE `user_id`= $user ORDER BY `date` DESC";
		$res= $con->query($query)->fetch_assoc();
		echo "Total Questions: ". $con->query($query)->num_rows. "<br>";
		$squery= "SELECT * FROM `answer` WHERE `user_id`= $user ORDER BY `date` DESC";
		$sres= $con->query($squery)->fetch_assoc();
		echo "Total Answers: ". $con->query($squery)->num_rows. "<br>";
		if($con->query($query)->num_rows!=0){
			echo "Recent Question: <br>". $res['title']."<br>".$res['content']. "<br>";
		}
		else{
			echo "Recent Question: No Recent Questions <br>";
		}
		if($con->query($squery)->num_rows!=0){
			echo "Recent Answer: <br>". $sres['content']. "<br>";
		}
		else{
			echo "Recent Answer: No Recent Answers <br>";
		}
?>
</body>
</html>