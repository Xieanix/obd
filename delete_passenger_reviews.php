<?php
if(isset($_POST["Reviews_number"]))
{
    include "connect.php";
    if (!$conn) {
      die("Ошибка: " . mysqli_connect_error());
    }
    $userid = mysqli_real_escape_string($conn, $_POST["Reviews_number"]);
    $sql = "DELETE FROM Passenger_reviews WHERE Reviews_number = '$userid'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: Passenger_reviews.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>