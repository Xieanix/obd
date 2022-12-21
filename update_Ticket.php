<?php
include "connect.php";
if (!$conn) {
    die("Ошибка: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>
<body>
<?php
// если запрос GET
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["Ticket_ID"]))
{
    $userid = mysqli_real_escape_string($conn, $_GET["Ticket_ID"]);
    $sql = "SELECT * FROM Ticket WHERE Ticket_ID = '$userid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $userpos = $row["Ticket_number"];
                $userneg = $row["Name_ID"];
                $usertext = $row["Ticket_price"];
                $usernum = $row["Place_of_arrival"];
                $userdep = $row["Place_of_departure"];
            }
            echo "<h3>Обновлення білету</h3>
                <form method='post'>
                    <input type='hidden' name='Ticket_ID' value='$userid' />
                    <p>Номер білету:
                    <input type='number' name='Ticket_number' value='$userpos' /></p>
                    <p>Назва:
                    <input type='text' name='Name_ID' value='$userneg' /></p>
                    <p>Вартість білету:
                    <input type='number' name='Ticket_price' value='$usertext' /></p>
                    <p>Місце відправки:
                    <input type='text' name='Place_of_arrival' value='$usernum' /></p>
                    <p>Місце прибуття:
                    <input type='text' name='Place_of_departure' value='$userdep' /></p>
                    <input type='submit' value='Сохранить'>
            </form>";
        }
        else{
            echo "<div>Білет не знайден</div>";
        }
        mysqli_free_result($result);
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["Ticket_ID"]) && isset($_POST["Ticket_number"]) && isset($_POST["Name_ID"]) && isset($_POST["Ticket_price"]) && isset($_POST["Place_of_arrival"]) && isset($_POST["Place_of_departure"])) {
      
    $userid = mysqli_real_escape_string($conn, $_POST["Ticket_ID"]);
    $userpos = mysqli_real_escape_string($conn, $_POST["Ticket_number"]);
    $userneg = mysqli_real_escape_string($conn, $_POST["Name_ID"]);
    $usertext = mysqli_real_escape_string($conn, $_POST["Ticket_price"]);
    $usernum = mysqli_real_escape_string($conn, $_POST["Place_of_arrival"]);
    $userdep = mysqli_real_escape_string($conn, $_POST["Place_of_departure"]);
      
    $sql = "UPDATE Ticket SET Ticket_number = '$userpos', Name_ID = '$userneg', Ticket_price = '$usertext', Place_of_arrival = '$usernum', Place_of_departure = '$userdep' WHERE Ticket_ID = '$userid'";
    if($result = mysqli_query($conn, $sql)){
        header("Location: Ticket.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
}
else{
    echo "Некоректні дані";
}
mysqli_close($conn);
?>
</body>
</html>
