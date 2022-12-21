<?php
			session_start();
			if(!isset($_SESSION["session_username"])):
				header("location:login.php");
			else:
		?>
<!DOCTYPE html>
<html>
	<head>
	<?php include("font.php"); ?>
		<title>Пасажирська станція</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/BD.css">
	</head>
	<body>
		<div class="divbg">
		<h2>Welcome, <?php echo $_SESSION['session_username'];?>!</h2>
  		<table>
			<th><a href="logout.php">Logout from system</a></th>
		</table>
		<h3 class="hehe">Choose table to work with:</h3>
  		<table>
  			<th><a href="index.php">Пасажири </a></th>
  			<th><a href="Passenger_reviews.php">Відгуки </a></th>
  			<th><a href="Station.php">Станції </a></th>
  			<th><a href="Ticket.php">Білети </a></th>
  		</table>
		</div>
	</body>
</html>
<?php
	endif;
?>