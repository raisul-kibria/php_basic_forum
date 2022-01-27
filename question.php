<?php
		require("db.php");
		$question= htmlspecialchars($_GET["question_id"]);
		$row= $con->query("SELECT * FROM `question` WHERE `question_id`= $question")->fetch_assoc();
		$user= $con->query("SELECT `name` FROM `user` WHERE `user_id`= $row[user_id]")->fetch_assoc();
?>
<!DOCTYPE html>
<head>
	<title>
		<?php
			
			echo $row['title'];
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
	if(isset($_POST['content'])){
			if(isset($_SESSION['name'])){
				$user_id= $luser['user_id'];
				$content= htmlspecialchars($_REQUEST['content']);
				$date= date("y-m-d h:m:sa");
				$query= "INSERT INTO `answer`(`content`, `user_id`, `question_id`, `date`) VALUES ('$content','$user_id','$question','$date')";
				$res= $con->query($query) or die($con->error);
				if ($res) {
					 echo "<script>alert('Successfully added');
 							</script><br>";
				}else{
					echo "<script>alert('Sorry something went Wrong. Please try again');
							</script><br>";
				}
		}else{
			echo "<script>if(confirm('You need to be logged in to answer a question. Login First.')){
								window.location.assign('login.php');
							}
					</script>";
			}
		}

		echo "<a href= user.php?user_id=". $row['user_id']. ">". $user['name']. "</a>". "<br>".
			 $row['date'].
			 "<h1>". $row['content']. "</h1><br>";
			 ?>
	<form method="POST">
		<label>Reply</label><br>
		<textarea name="content"></textarea>
		<br>
		<input type="submit" value="Submit">
	</form>
	<br>
	<?php 
		$query= "SELECT * FROM `answer` WHERE `question_id`= $row[question_id]";
		$res= $con->query($query);

		if ($res->num_rows==0) {
			echo "<br>Not yet answered";
		}else{
			while ($rows=$res->fetch_assoc()) {
				$user= $con->query("SELECT `name` FROM `user` WHERE `user_id`= $rows[user_id]")->fetch_assoc();
				echo "<a href= user.php?user_id=". $rows['user_id']. ">". $user['name']. "</a>". " ".
	   				$rows['date']. " ". $rows['content']."<br>";
			}
		}
?>
</body>
</html>