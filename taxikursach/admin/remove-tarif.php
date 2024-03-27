<?php
    include("../connectDB.php");

    if(isset($_GET['id'])) {
        $tarif_id = $_GET['id'];

        $delete_query = "DELETE FROM tarifs WHERE id = $tarif_id";
        if(mysqli_query($connect, $delete_query)) {
            header("Location: admin.php"); // Перенаправление на страницу со списком тарифов
            exit();
        } else {
            echo "Ошибка удаления тарифа: " . mysqli_error($connect);
        }
    } else {
        echo "Некорректный запрос";
    }
?>