<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

include("../database/connectDB.php");

if ($connect->connect_error) {
    die("Ошибка подключения к базе данных: " . $connect->connect_error);
}

// Получаем ID машины из URL
$carId = $_GET['cars_id'] ?? null;

if ($carId) {
    // Обновляем статус машины в базе данных
    $sql = "UPDATE cars SET status = 'Активна' WHERE id_cars = $carId";
    if ($connect->query($sql) === TRUE) {
        echo "<script>alert('Машина успешно восстановлена!'); location.href='control-cars.php';</script>";
    } else {
        echo "Ошибка при обновлении статуса машины: " . $connect->error;
    }
} else {
    echo "ID машины не указан.";
}

// Закрываем соединение с базой данных
$connect->close();
