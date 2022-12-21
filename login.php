<!DOCTYPE html>
<html lang="en">
<head>
<?php include("font.php"); ?>
	<meta charset="utf-8">
	<title>Log in</title>
	<link rel="stylesheet" href="css/BD.css">
	<?php include("connect.php");?>
</head> 
<body>
	<div class="divbg">
		<div class="regform">
			<h2>Login</h2>
			<form action="" id="loginform" method="post"name="loginform">
				<p><label for="user_login">Username<br>
					<input class="input" id="username" name="username"size="20"
					type="text" value=""></label></p>
					<p><label for="user_pass">Password<br>
						<input class="input" id="password" name="password"size="20"
						type="password" value=""></label></p> 
					<p class="submit"><input class="button" name="login"type= "submit" value="Log In"></p>
					<div class="regtext">
						<p>Wanna sing up? <a href= "register.php">Registration</a>!</p>
					</div>
			</form>
		</div>
	</div>
	<iframe width="1905" height="720" src="https://www.youtube.com/embed/HN2UZ24gDbM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</body>
</html>
<?php
//width="1905" height="720"
    session_start();
?>

<?php
    include("connect.php");
	if(isset($_SESSION["session_username"])){
		header("Location: intropage.php");
	}
		if(isset($_POST["login"])){
			if(!empty($_POST['username']) && !empty($_POST['password'])) {
				$username = htmlspecialchars($_POST['username']);
				$password = htmlspecialchars($_POST['password']);
                $sql = "SELECT * FROM usertbl WHERE username = '$username' AND password = '$password'";
				$result = mysqli_query($conn, $sql);
				$numrows = mysqli_num_rows($result);
				if($numrows != 0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
						$dbusername = $row['username'];
						$dbpassword = $row['password'];
						$dbuserlevel = $row['level'];
						include "cookie.php";
					}
					if($username == $dbusername && $password == $dbpassword)
					{
						$_SESSION['session_username'] = $username;
						header("Location: intropage.php");
					}
				} else {
					echo  "Invalid username or password!";
				}
			} else {
				$message = "All fields are required!";
			}
		}
?>