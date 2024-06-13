<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

include("../database/connectDB.php");

if (isset($_GET['id']) && isset($_GET['status'])) {
    $tarif_id = $_GET['id'];
    $new_status = ($_GET['status'] == 'активен') ? 'неактивен' : 'активен';

    $update_query = "UPDATE tarifs SET status_tarif = '$new_status' WHERE id = $tarif_id";
    if (mysqli_query($connect, $update_query)) {
        header("Location: admin.php"); // Перенаправление на страницу со списком тарифов
        exit();
    } else {
        echo "Ошибка изменения статуса тарифа: " . mysqli_error($connect);
    }
} else {
    echo "Некорректный запрос";
}
