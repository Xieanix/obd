<!DOCTYPE html>
<html>
<head>
<?php include("font.php"); ?>
<meta charset="utf-8" />
</head>
<link rel="stylesheet" href="css/BD.css">
<body>
<h2>Список відгуків</h2>
<table>
    <tr>
        <th><a href="index.php">Пасажири</a></th>
        <th><a href="Station.php">Станції</a></th>
        <th><a href="Ticket.php">Білет</a></th>
        <th><?php echo $_COOKIE["usernamecookie"];?></th>
        <th><a href="logout.php">Вийти</a></th>
    </tr>
</table>
<?php
session_start();
if(!isset($_SESSION["session_username"])):
header("location:login.php");
endif;
include "connect.php";
if (!$conn) {
  die("Помилка: " . mysqli_connect_error());
}
$sql = "SELECT * FROM Passenger_reviews";
if($result = mysqli_query($conn, $sql)){
    echo "<table><tr><th>Reviews_number</th><th>Number_of_positive</th><th>Number_of_negative</th><th>Reviews_text</th><th>Ticket_number<th></th><th></th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["Reviews_number"] . "</td>";
            echo "<td>" . $row["Number_of_positive"] . "</td>";
            echo "<td>" . $row["Number_of_negative"] . "</td>";
            echo "<td>" . $row["Reviews_text"] . "</td>";
            echo "<td>" . $row["Ticket_number"] . "</td>";
            if('admin' == $_COOKIE['userlevelcookie']){
            echo "<td><a href='update_passenger_reviews.php?Reviews_number=" . $row["Reviews_number"] . "'>Змінити</a></td>";
            echo "<td><form action='delete_passenger_reviews.php' method='post'>
            <input type='hidden' name='Reviews_number' value='" . $row["Reviews_number"] . "'>
            <input type='submit' value='Видалити'></form></td>";
            }
            else{
            echo "<td></td>";
            echo "<td></td>"; 
            }
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
} else{
    echo "Помилка: " . mysqli_error($conn);
}
mysqli_close($conn);
if('admin' == $_COOKIE["userlevelcookie"])
echo "<table>
    <tr>
        <th><a href='form_passenger_reviews.php'>Додати новий відгук</a></th>
    </tr>
</table>"
?>
</body>
</html>