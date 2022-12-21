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
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["Name_ID"]))
{
    $userid = mysqli_real_escape_string($conn, $_GET["Name_ID"]);
    $sql = "SELECT * FROM Station WHERE Name_ID = '$userid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $username = $row["Number_of_cash_desks"];
                $usertname = $row["Location"];
                $usernum = $row["Number_of_tracks"];
            }
            echo "<h3>Обновлення станції</h3>
                <form method='post'>
                    <input type='hidden' name='Name_ID' value='$userid' />
                    <p>Кількість колій:
                    <input type='number' name='Number_of_cash_desks' value='$username' /></p>
                    <p>Місцезнаходження:
                    <input type='text' name='Location' value='$usertname' /></p>
                    <p>Кількість вагонів:
                    <input type='number' name='Number_of_tracks' value='$usernum' /></p>
                    <input type='submit' value='Сохранить'>
            </form>";
        }
        else{
            echo "<div>Станція не знайдена</div>";
        }
        mysqli_free_result($result);
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["Name_ID"]) && isset($_POST["Number_of_cash_desks"]) && isset($_POST["Location"]) && isset($_POST["Number_of_tracks"])) {
      
    $userid = mysqli_real_escape_string($conn, $_POST["Name_ID"]);
    $username = mysqli_real_escape_string($conn, $_POST["Number_of_cash_desks"]);
    $usertname = mysqli_real_escape_string($conn, $_POST["Location"]);
    $usernum = mysqli_real_escape_string($conn, $_POST["Number_of_tracks"]);
      
    $sql = "UPDATE Station SET Number_of_cash_desks = '$username', Location = '$usertname', Number_of_tracks = '$usernum' WHERE Name_ID = '$userid'";
    if($result = mysqli_query($conn, $sql)){
        header("Location: Station.php");
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