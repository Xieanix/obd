<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>
<link rel="stylesheet" href="css/BD.css">
<body>
<h2>Список білетів</h2>
<table>
    <tr>
        <th><a href="Passenger_reviews.php">Відгуки</a></th>
        <th><a href="Station.php">Станції</a></th>
        <th><a href="index.php">Пасажири</a></th>
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
$sql = "SELECT * FROM Ticket";
if($result = mysqli_query($conn, $sql)){
    echo "<table><tr><th>Ticket_ID</th><th>Ticket_number</th><th>Name_ID</th><th>Ticket_price</th><th>Place_of_arrival</th><th>Place_of_departure</th><th></th><th></th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["Ticket_ID"] . "</td>";
            echo "<td>" . $row["Ticket_number"] . "</td>";
            echo "<td>" . $row["Name_ID"] . "</td>";
            echo "<td>" . $row["Ticket_price"] . "</td>";
            if('admin' == $_COOKIE['userlevelcookie']){
            echo "<td>" . $row["Place_of_arrival"] . "</td>";
            }else echo "<td>RESTRICTED</td>";
            if('admin' == $_COOKIE['userlevelcookie']){
            echo "<td>" . $row["Place_of_departure"] . "</td>";
            }else echo "<td>RESTRICTED</td>";
            if('admin' == $_COOKIE['userlevelcookie']){
            echo "<td><a href='update_Ticket.php?Ticket_ID=" . $row["Ticket_ID"] . "'>Змінити</a></td>";
            echo "<td><form action='delete_Ticket.php' method='post'>
            <input type='hidden' name='Ticket_ID' value='" . $row["Ticket_ID"] . "'>
            <input type='submit' value='Видалити'>
            </form></td>";
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
        <th><a href='form_ticket.php'>Додати новий білет</a></th>
    </tr>
</table>"
?>
</body>
</html>