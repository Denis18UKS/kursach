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
    $sql = "UPDATE drivers SET status_driver = 'Активен' WHERE id = $driverId";
    if (mysqli_query($connect, $sql) === TRUE) {
        echo "<script>alert('Водитель успешно восстановлен'); location.href='control-drivers.php';</script>";
    } else {
        echo "Ошибка при восстановлении водителя: " . $connect->error;
    }
} else {
    echo "ID водителя не указан.";
}

$connect->close();
