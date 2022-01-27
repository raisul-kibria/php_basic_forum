<?php
		require("db.php");
		$category= htmlspecialchars($_GET["category_id"]);
?>
<html>
<head>
	<title>
		<?php
			$title= $con->query("SELECT `name` FROM `categories` WHERE `category_id`= $category")->fetch_assoc();
			echo $title['name'];
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
		$query= "SELECT * FROM `question` WHERE `category_id`= $category ORDER BY `date` DESC";
		$result = $con->query($query) or die($con->error);
		if ($result->num_rows==0) {
			echo "No Questions on this category yet. Add yours <a href=addques.php>Here</a>";
		}
		else{
			while($row= $result->fetch_assoc()) {
				$user= $con->query("SELECT `name` FROM `user` WHERE `user_id`= $row[user_id]")->fetch_assoc();
	   			echo "<a href= user.php?user_id=". $row['user_id']. ">". $user['name']. "</a>". " ".
	   				 $row['date']. " ". 
	   				 "<a href= question.php?question_id=". $row['question_id']. ">". $row['title']."</a>"."<br>";
			}
		}
	?>

</body>
</html>