<?php
if (isset($_POST["Firstname"]) && isset($_POST["Lastname"]) && isset($_POST["Phone_number"])) {
    include "connect.php";
    if (!$conn) {
      die("Ошибка: " . mysqli_connect_error());
    }
    $Firstname = mysqli_real_escape_string($conn, $_POST["Firstname"]);
    $Lastname = mysqli_real_escape_string($conn, $_POST["Lastname"]);
    $abs = mysqli_real_escape_string($conn, $_POST["Phone_number"]);
    $sql = ("INSERT INTO `Passenger` SET `Firstname` = '".$Firstname."', `Lastname` = '".$Lastname."', `Phone_number` = '".$abs."'");
    if(mysqli_query($conn, $sql)){
        header("Location: index.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>