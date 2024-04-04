<?php
    include "../connectDB.php";

    $sql = "SELECT * FROM orders";
    $result = mysqli_query($connect, $sql);
?>