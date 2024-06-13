<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

include("../database/connectDB.php");

if ($connect->connect_error) {
    die("Ошибка подключения к БД: " . $connect->connect_error);
}

$carId = $_GET['cars_id'] ?? null;

if ($carId) {
    // Проверяем, используется ли машина водителем
    $checkSql = "SELECT id FROM drivers WHERE id_cars = $carId";
    $checkResult = mysqli_query($connect, $checkSql);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('Машина не может быть списана, так как она прикреплена к водителю'); location.href='control-cars.php';</script>";
    } else {
        // Если машина не используется, списываем ее
        $sql = "UPDATE cars SET status = 'Списана' WHERE id_cars = $carId";
        if (mysqli_query($connect, $sql) === TRUE) {
            echo "<script>alert('Машина успешно списана'); location.href='control-cars.php';</script>";
        } else {
            echo "Ошибка при списании машины: " . $connect->error;
        }
    }

    $connect->close();
} else {
    echo "ID машины не указан.";
}
