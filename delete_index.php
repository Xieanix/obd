<?php
if(isset($_POST["Ticket_number"]))
{
    include "connect.php";
    if (!$conn) {
      die("Ошибка: " . mysqli_connect_error());
    }
    $userid = mysqli_real_escape_string($conn, $_POST["Ticket_number"]);
    $sql = "DELETE FROM Passenger WHERE Ticket_number = '$userid'";
    if(mysqli_query($conn, $sql)){     
        header("Location: index.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>