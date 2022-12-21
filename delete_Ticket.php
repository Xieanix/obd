<?php
if(isset($_POST["Ticket_ID"]))
{
    include "connect.php";
    if (!$conn) {
      die("Ошибка: " . mysqli_connect_error());
    }
    $userTicket_ID = mysqli_real_escape_string($conn, $_POST["Ticket_ID"]);
    $sql = "DELETE FROM Ticket WHERE Ticket_ID = '$userTicket_ID'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: Ticket.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>