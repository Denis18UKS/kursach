<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

include("../database/connectDB.php");

if ($connect->connect_error) {
    die("Ошибка подключения к БД: " . $connect->connect_error);
}

$driverId = $_GET['driver_id'] ?? null;

if ($driverId) {
    // Обновляем статус водителя в базе данных
    $sql = "UPDATE drivers SET status_driver = 'Заблокирован' WHERE `id` = $driverId";
    if (mysqli_query($connect, $sql) === TRUE) {
        echo "<script>alert('Водитель успешно заблокирован'); location.href='control-drivers.php';</script>";
    } else {
        echo "Ошибка при блокировании водителя: " . $connect->error;
    }
} else if (isset($_GET['remove'])) {
    $sql = "DELETE FROM `drivers` WHERE `id` = $driverId";
    $result = mysqli_query($connect, $sql);
    echo "<script>alert('Водитель успешно удалён');location.href='control-drivers.php'</script>";
} else {
    echo "ID водителя не указан.";
}

$connect->close();
