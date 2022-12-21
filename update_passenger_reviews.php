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
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["Reviews_number"]))
{
    $userid = mysqli_real_escape_string($conn, $_GET["Reviews_number"]);
    $sql = "SELECT * FROM Passenger_reviews WHERE Reviews_number = '$userid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $userpos = $row["Number_of_positive"];
                $userneg = $row["Number_of_negative"];
                $usertext = $row["Reviews_text"];
                $usernum = $row["Ticket_number"];
            }
            echo "<h3>Обновлення відгуку</h3>
                <form method='post'>
                    <input type='hidden' name='Reviews_number' value='$userid' />
                    <p>Кількість позитивних:
                    <input type='text' name='Number_of_positive' value='$userpos' /></p>
                    <p>Кількість негативних:
                    <input type='number' name='Number_of_negative' value='$userneg' /></p>
                    <p>Текст:
                    <input type='text' name='Reviews_text' value='$usertext' /></p>
                    <p>Номер квитка:
                    <input type='number' name='Ticket_number' value='$usernum' /></p>
                    <input type='submit' value='Сохранить'>
            </form>";
        }
        else{
            echo "<div>Відгук не знайден</div>";
        }
        mysqli_free_result($result);
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["Reviews_number"]) && isset($_POST["Number_of_positive"]) && isset($_POST["Number_of_negative"]) && isset($_POST["Reviews_text"]) && isset($_POST["Ticket_number"])) {
      
    $userid = mysqli_real_escape_string($conn, $_POST["Reviews_number"]);
    $userpos = mysqli_real_escape_string($conn, $_POST["Number_of_positive"]);
    $userneg = mysqli_real_escape_string($conn, $_POST["Number_of_negative"]);
    $usertext = mysqli_real_escape_string($conn, $_POST["Reviews_text"]);
    $usernum = mysqli_real_escape_string($conn, $_POST["Ticket_number"]);
      
    $sql = "UPDATE Passenger_reviews SET Number_of_positive = '$userpos', Number_of_negative = '$userneg', Reviews_text = '$usertext', Ticket_number = '$usernum' WHERE Reviews_number = '$userid'";
    if($result = mysqli_query($conn, $sql)){
        header("Location: Passenger_reviews.php");
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