<?php
if(isset($_POST["Name_ID"]))
{
    include "connect.php";
    if (!$conn) {
      die("Ошибка: " . mysqli_connect_error());
    }
    $userName = mysqli_real_escape_string($conn, $_POST["Name_ID"]);
    $sql = "DELETE FROM Station WHERE Name_ID = '$userName'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: Station.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>