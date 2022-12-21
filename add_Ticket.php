<?php
if (isset($_POST["Ticket_number"]) && isset($_POST["Name_ID"]) && isset($_POST["Ticket_price"]) && isset($_POST["Place_of_arrival"]) && isset($_POST["Place_of_departure"])) {
      
    include "connect.php";
    if (!$conn) {
      die("Ошибка: " . mysqli_connect_error());
    }
    $name = mysqli_real_escape_string($conn, $_POST["Ticket_number"]);
    $tname = mysqli_real_escape_string($conn, $_POST["Name_ID"]);
    $num = mysqli_real_escape_string($conn, $_POST["Ticket_price"]);
    $abo = mysqli_real_escape_string($conn, $_POST["Place_of_arrival"]);
    $iop = mysqli_real_escape_string($conn, $_POST["Place_of_departure"]);
    $sql = "INSERT INTO Ticket (Ticket_number, Name_ID, Ticket_price, Place_of_arrival, Place_of_departure) VALUES ('$name', '$tname', '$num', '$abo', '$iop')";
        if(mysqli_query($conn, $sql)){
            header("Location: Ticket.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>