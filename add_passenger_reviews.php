<?php
if (isset($_POST["Number_of_positive"]) && isset($_POST["Number_of_negative"]) && isset($_POST["Reviews_text"]) && isset($_POST["Ticket_number"])) {
      
    include "connect.php";
    if (!$conn) {
      die("Ошибка: " . mysqli_connect_error());
    }
    $name = mysqli_real_escape_string($conn, $_POST["Number_of_positive"]);
    $tname = mysqli_real_escape_string($conn, $_POST["Number_of_negative"]);
    $num = mysqli_real_escape_string($conn, $_POST["Reviews_text"]);
    $abo = mysqli_real_escape_string($conn, $_POST["Ticket_number"]);
    $sql = "INSERT INTO Passenger_reviews (Number_of_positive, Number_of_negative, Reviews_text, Ticket_number) VALUES ('$name', '$tname', '$num', '$abo')";
        if(mysqli_query($conn, $sql)){
            header("Location: passenger_reviews.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>