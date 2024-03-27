<?php
    include("../connectDB.php");

    if(isset($_GET['programs_id'])) {
        $programs_id = $_GET['programs_id'];

        $delete_query = "DELETE FROM `Programms` WHERE id = $programs_id";
        
        if(mysqli_query($connect, $delete_query)) {
            echo "<script>location.href= 'control-programs.php'; </script>";
        } else {
            echo "Ошибка при удалении методички: " . mysqli_error($connect);
        }
    } else {
        echo "<script>alert('Идентификатор программы не передан'); location.href= 'control-programs.php';</script>";
    }
?>