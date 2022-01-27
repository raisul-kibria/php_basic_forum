<?php
	require("db.php"); 
?>
<html>
	<head>
		<title>Register </title>
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
	<?php
		if(!isset($_SESSION["name"])){
			if (isset($_POST['name'])) {
				$name= htmlspecialchars($_REQUEST['name']);
				$password= htmlspecialchars($_REQUEST['password']);
				$date= date("Y-m-d");
				$res= $con->query("SELECT * FROM `user` WHERE `name`= '$name'");
				if($res->num_rows!=0){
					echo "<script>alert('User already Registered. Please log in');
								window.location.assign('login.php');
							</script><br>";
				}else{
				$query= "INSERT INTO `user`(`name`, `date`, `password`) VALUES ('$name', '$date', '$password')";
				$res= $con->query($query) or die($con->error);
				if ($res) {
					echo "<script>alert('Successfully Registered. Please log in');
								window.location.assign('login.php');
							</script><br>";
				}else{
					echo "<script>alert('Sorry something went Wrong. Please try again');
							</script><br>";
				}
			}
		}
	}
		else{
			echo "<script>alert('User already Logged in');
								window.location.assign('index.php');
							</script><br>";
		}
		?>
	<h3>Register Here</h3>
	<form method="POST">
		<label>Username: </label>
		<input type="text" name="name">
		<label>Password: </label>
		<input type="password" name="password">
		<input type="submit" name="submit" value="Submit">
	</form>
	</body>
</html>