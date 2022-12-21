<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>
<link rel="stylesheet" href="css/BD.css">
<body>
<h2>Список станцій</h2>
<table>
    <tr>
        <th><a href="Passenger_reviews.php">Відгуки</a></th>
        <th><a href="index.php">Пасажири</a></th>
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
$sql = "SELECT * FROM Station";
if($result = mysqli_query($conn, $sql)){
     
    echo "<table><tr><th>Name_ID</th><th>Number_of_cash_desks</th><th>Location</th><th>Number_of_tracks<th></th><th></th></th>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["Name_ID"] . "</td>";
            echo "<td>" . $row["Number_of_cash_desks"] . "</td>";
            echo "<td>" . $row["Location"] . "</td>";
            if('admin' == $_COOKIE['userlevelcookie']){
            echo "<td>" . $row["Number_of_tracks"] . "</td>";
            }else echo "<td>RESTRICTED</td>";      
            if('admin' == $_COOKIE['userlevelcookie']){
            echo "<td><a href='update_Station.php?Name_ID=" . $row["Name_ID"] . "'>Змінити</a></td>";
            echo "<td><form action='delete_Station.php' method='post'>
            <input type='hidden' name='Name_ID' value='" . $row["Name_ID"] . "'>
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
        <th><a href='form_station.php'>Додати нову станцію</a></th>
    </tr>
</table>"
?>
</body>
</html>