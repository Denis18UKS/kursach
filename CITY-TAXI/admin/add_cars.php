<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

include "../database/connectDB.php";

if ($connect->connect_error) {
    die("Ошибка подключения к базе данных: " . $connect->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $model_car = $_POST['model_car'];
    $number_car = $_POST['number_car'];

    if (empty($model_car) || empty($number_car)) {
        echo "<script>alert('Заполните все поля!');location.href='';";
    } else {
        // Готовим SQL запрос для добавления водителя в базу данных

        $sql = "INSERT INTO cars (model_car, number_car, status) VALUES ('$model_car',$number_car,'активна')";

        if ($connect->query($sql) === TRUE) {
            echo "<script>alert('Машина была успешно добавлена'); location.href='control-cars.php';</script>";
        } else {
            echo "Ошибка при добавлении машины в базу данных: " . $connect->error;
        }
    }
} else {
    echo "Данные не были отправлены методом POST";
}

// Закрываем соединение с базой данных
$connect->close();
