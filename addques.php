<?php
	require("db.php"); 
?>
<html>
	<head>
		<title>Add a Question</title>
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
			echo "<button onclick=window.location.assign('logout.php')>Logout</button><br>"."<br>";
		}
		if(isset($_SESSION['name'])){
			if(isset($_POST['title'])){
				$title= htmlspecialchars($_REQUEST['title']);
				$user_id= $luser['user_id'];
				$content= htmlspecialchars($_REQUEST['content']);
				$tags= htmlspecialchars($_REQUEST['tags']);
				$date= date("y-m-d h:m:sa");
				$category_id= $_REQUEST['category_id'];
				$query= "INSERT INTO `question`(`title`, `content`, `date`, `user_id`, `tags`, `category_id`) VALUES ('$title','$content','$date','$user_id','$tags','$category_id')";
				$res= $con->query($query) or die($con->error);
				if ($res) {
					 echo "<script>alert('Successfully added');
								window.location.assign('category.php?category_id=". $category_id."');
							</script><br>";
				}else{
					echo "<script>alert('Sorry something went Wrong. Please try again');
							</script><br>";
				}

		}
	}else{
		echo "<script>if(confirm('You need to be logged in to add a question. Login First.')){
							window.location.assign('login.php');
						}else{
							window.history.go(-1); 
						}
				</script>";
	}
	?>
	<form method="POST">
		<label>Title</label><br>
		<input type="text" name="title" required>
		<br>
		<label>Add details</label><br>
		<textarea name="content">...</textarea>
		<br>
		<select name="category_id" required>
			<option value="1">Programming</option>
			<option value="2">Web Design</option>
			<option value="3">Graphics Design</option>
			<option value="4">Networking</option>
			<option value="5">Web Development</option>
			<option value="6">Robotics</option>
		</select>
		<br>
		<label>Tags</label>
		<input type="text" name="tags">
		<br>
		<input type="submit" name="submit" value="Submit">
	</form>

	</body>
</html> 