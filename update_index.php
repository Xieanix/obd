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
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["Ticket_number"]))
{
    $userid = mysqli_real_escape_string($conn, $_GET["Ticket_number"]);
    $sql = "SELECT * FROM Passenger WHERE Ticket_number = '$userid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $username = $row["Firstname"];
                $usertname = $row["Lastname"];
                $usernum = $row["Phone_number"];
            }
            echo "<h3>Обновлення пасажиру</h3>
                <form method='post'>
                    <input type='hidden' name='Ticket_number' value='$userid' />
                    <p>Ім'я:
                    <input type='text' name='Firstname' value='$username' /></p>
                    <p>Прізвище:
                    <input type='text' name='Lastname' value='$usertname' /></p>
                    <p>Номер телефону:
                    <input type='number' name='Phone_number' value='$usernum' /></p>
                    <input type='submit' value='Сохранить'>
            </form>";
        }
        else{
            echo "<div>пасажир не знайден</div>";
        }
        mysqli_free_result($result);
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["Ticket_number"]) && isset($_POST["Firstname"]) && isset($_POST["Lastname"]) && isset($_POST["Phone_number"])) {
      
    $userid = mysqli_real_escape_string($conn, $_POST["Ticket_number"]);
    $username = mysqli_real_escape_string($conn, $_POST["Firstname"]);
    $usertname = mysqli_real_escape_string($conn, $_POST["Lastname"]);
    $usernum = mysqli_real_escape_string($conn, $_POST["Phone_number"]);
      
    $sql = "UPDATE Passenger SET Firstname = '$username', Lastname = '$usertname', Phone_number = '$usernum' WHERE Ticket_number = '$userid'";
    if($result = mysqli_query($conn, $sql)){
        header("Location: index.php");
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