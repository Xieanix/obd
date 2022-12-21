<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>
<?php include("font.php"); ?>
<link rel="stylesheet" href="css/BD.css">
<body>
<h2>Список пасажирів</h2>
<table>
    <tr>
        <th><a href="Passenger_reviews.php">Відгуки</a></th>
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
$sql = "SELECT * FROM Passenger";
if($result = mysqli_query($conn, $sql)){
    echo "<table><tr><th>Ticket_number</th><th>Firstname</th><th>Lastname</th><th>Phone_number</th><th></th><th></th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["Ticket_number"] . "</td>";
            echo "<td>" . $row["Firstname"] . "</td>";
            echo "<td>" . $row["Lastname"] . "</td>";
            if('admin' == $_COOKIE['userlevelcookie']){
            echo "<td>" . $row["Phone_number"] . "</td>";
            }else echo "<td>RESTRICTED</td>";
            if('admin' == $_COOKIE['userlevelcookie']){
            echo "<td><a href='update_index.php?Ticket_number=" . $row["Ticket_number"] . "'>Змінити</a></td>";
            echo "<td><form action='delete_index.php' method='post'>
                    <input type='hidden' name='Ticket_number' value='" . $row["Ticket_number"] . "'/>
                    <input type='submit' class='button' value='Видалити'>
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
        <th><a href='form_index.php'>Додати нового пасажира</a></th>
    </tr>
</table>"
?>
</body>
</html>