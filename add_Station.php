<?php
if (isset($_POST["Number_of_cash_desks"]) && isset($_POST["Location"]) && isset($_POST["Number_of_tracks"])) {
      
    include "connect.php";
    if (!$conn) {
      die("Ошибка: " . mysqli_connect_error());
    }
    $name = mysqli_real_escape_string($conn, $_POST["Number_of_cash_desks"]);
    $tname = mysqli_real_escape_string($conn, $_POST["Location"]);
    $num = mysqli_real_escape_string($conn, $_POST["Number_of_tracks"]);
    $sql = "INSERT INTO Station (Number_of_cash_desks, Location, Number_of_tracks) VALUES ('$name', '$tname', '$num')";
        if(mysqli_query($conn, $sql)){
            header("Location: Station.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>