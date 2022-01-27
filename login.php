<?php
	require("db.php"); 
?>
<html>
	<head>
		<title>Log In</title>
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
	?>
		<?php
			if(!isset($_SESSION["name"])){
				session_start();
				if(isset($_POST['name'])){
					$name= htmlspecialchars($_REQUEST['name']);
					$password= htmlspecialchars($_REQUEST['password']);
					$query= "SELECT * FROM `user` WHERE `name`= '$name' AND `password`= '$password' ";
					$res=$con->query($query) or die($con->error);
					if ($res->num_rows==0) {
						echo "<br><div>Username/Password is incorrect</div>";
					}
					else{
						$_SESSION['name']= $name;
						header("Location: index.php");
					}
				}
				}
				else{
					echo "<script>alert('User already Logged in');
								window.location.assign('index.php');
							</script><br>";
					
				}
			?>
			<br>
		<form method="post">
			<label>Username: </label><input type="text" name="name" required>
			<label>Password: </label><input type="Password" name="password" required>
			<input type="submit" value="Submit" name="submit">			
		</form>
	</body>
</html>  